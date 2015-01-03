<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \Industry;

class IndustriesController extends \BaseController
{

    protected $permission = 'manage_playbook_meta';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $industries = Industry::paginate(25);

        return View::make('admin.industries.index')
            ->with('industries', $industries);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.industries.form')
            ->with('title', 'Add New Industry')
            ->with('method', 'post')
            ->with('action', 'admin.industries.store')
            ->with('industry', new Industry());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $industry = Industry::create(Input::all());

        if ($industry->save()) {
            return Redirect::route('admin.industries.show', $industry->id)
                ->withMessage('The industry was successfully added.');
        } else {
            return Redirect::route('admin.industries.create')
                ->withError('The industry could not be saved. ' .
                    'See below for more information.')
                ->withErrors($industry->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  Industry $industry
     * @return Response
     */
    public function show($industry)
    {
        return View::make('admin.industries.form')
            ->with('title', "Edit Industry: {$industry->name}")
            ->with('action', ['admin.industries.update', $industry->id])
            ->with('method', 'put')
            ->with('industry', $industry);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Industry $industry
     * @return Response
     */
    public function update($industry)
    {
        $industry->name = Input::get('name');

        if ($industry->save()) {
            return Redirect::route('admin.industries.show', $industry->id)
                ->withMessage('The industry has been successfully updated.');
        } else {
            return Redirect::route('admin.industries.show', $industry->id)
                ->withError('The industry could not be updated. ' .
                    'See below for more information.')
                ->withErrors($industry->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Industry $industry
     * @return Response
     */
    public function destroy($industry)
    {
        $industry->delete();

        return Redirect::route('admin.industries.index')
            ->withMessage('The industry has been deleted.');
    }


}
