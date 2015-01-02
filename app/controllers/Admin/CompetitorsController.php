<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \Competitor;

class CompetitorsController extends \BaseController {

    protected $permission = 'manage_playbook_meta';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $competitors = Competitor::paginate(25);

        return View::make('admin.competitors.index')
            ->with('competitors', $competitors);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.competitors.form')
            ->with('title', 'Add a New Competitor')
            ->with('action', 'admin.competitors.store')
            ->with('method', 'post')
            ->with('competitor', new Competitor());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $competitor = Competitor::create(Input::all());

        if ($competitor->save()) {
            return Redirect::route('admin.competitors.show', $competitor->id)
                ->withMessage('The competitor has been successfully created');
        } else {
            return Redirect::route('admin.competitors.create')
                ->withError('The competitor could not be saved. ' .
                    'See below for more information')
                ->withInput()
                ->withErrors($competitor->errors());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  Competitor  $competitor
     * @return Response
     */
    public function show($competitor)
    {
        return View::make('admin.competitors.form')
            ->with('title', "Edit Competitor: {$competitor->name}")
            ->with('action', ['admin.competitors.update', $competitor->id])
            ->with('method', 'put')
            ->with('competitor', $competitor);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Competitor  $competitor
     * @return Response
     */
    public function update($competitor)
    {
        $competitor->name = Input::get('name');

        if ($competitor->save()) {
            return Redirect::route('admin.competitors.show', $competitor->id)
                ->withMessage('The competitor has been updated');
        } else {
            return Redirect::route('admin.competitors.show', $competitor->id)
                ->withError('The competitor could not be saved. ' .
                    'See below for more information')
                ->withInput()
                ->withErrors($competitor->errors());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Competitor  $competitor
     * @return Response
     */
    public function destroy($competitor)
    {
        $competitor->delete();

        return Redirect::route('admin.competitors.index')
            ->withMessage('The competitor has been deleted');
    }


}
