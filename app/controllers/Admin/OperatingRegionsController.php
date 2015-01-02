<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \OperatingRegion;

class OperatingRegionsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $regions = OperatingRegion::paginate(25);

        return View::make('admin.operating-regions.index')
            ->with('regions', $regions);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.operating-regions.form')
            ->with('title', 'Add New Operating Region')
            ->with('action', 'admin.operating-regions.store')
            ->with('method', 'post')
            ->with('region', new OperatingRegion());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $region = OperatingRegion::create(Input::all());

        if ($region->save()) {
            return Redirect::route('admin.operating-regions.show', $region->id)
                ->withMessage('The region has been created successfully.');
        } else {
            return Redirect::route('admin.operating-regions.create')
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($region->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  OperatingRegion  $region
     * @return Response
     */
    public function show($region)
    {
        return View::make('admin.operating-regions.form')
            ->with('title', "Edit Region: {$region->name}")
            ->with('action', ['admin.operating-regions.update', $region->id])
            ->with('method', 'put')
            ->with('region', $region);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  OperatingRegion  $region
     * @return Response
     */
    public function update($region)
    {
        $region->name = Input::get('name');

        if ($region->save()) {
            return Redirect::route('admin.operating-regions.show', $region->id)
                ->withMessage('The item has been successfully updated.');
        } else {
            return Redirect::route('admin.operating-regions.show', $region->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($region->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  OperatingRegion  $region
     * @return Response
     */
    public function destroy($region)
    {
        $region->delete();

        return Redirect::route('admin.operating-regions.index')
            ->withMessage('The item has been deleted.');
    }


}
