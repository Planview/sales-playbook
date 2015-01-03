<?php

namespace Admin;

use \View;
use \Response;
use \Input;
use \Redirect;

use \PlanviewRegion;

class PlanviewRegionsController extends \BaseController
{

    protected $permission = 'manage_playbook_meta';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $regions = PlanviewRegion::paginate(25);

        return View::make('admin.planview-regions.index')
            ->with('regions', $regions);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.planview-regions.form')
            ->with('title', 'Add New Sales Region')
            ->with('action', 'admin.planview-regions.store')
            ->with('method', 'post')
            ->with('region', new PlanviewRegion());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $region = PlanviewRegion::create(Input::all());

        if ($region->save()) {
            return Redirect::route('admin.planview-regions.show', $region->id)
                ->withMessage('The item has been successfully created.');
        } else {
            return Redirect::route('admin.planview-regions.create')
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($region->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  PlanviewRegion   $region
     * @return Response
     */
    public function show($region)
    {
        return View::make('admin.planview-regions.form')
            ->with('title', "Edit Region: {$region->name}")
            ->with('action', ['admin.planview-regions.update', $region->id])
            ->with('method', 'put')
            ->with('region', $region);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PlanviewRegion   $region
     * @return Response
     */
    public function update($region)
    {
        $region->name = Input::get('name');

        if ($region->save()) {
            return Redirect::route('admin.planview-regions.show', $region->id)
                ->withMessage('The item has been successfully updated.');
        } else {
            return Redirect::route('admin.planview-regions.show', $region->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($region->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  PlanviewRegion   $region
     * @return Response
     */
    public function destroy($region)
    {
        $region->delete();

        return Redirect::route('admin.planview-regions.index')
            ->withMessage('The item has been deleted.');
    }

}
