<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use PlanviewSubRegion;
use PlanviewRegion;

class PlanviewSubRegionsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subregions = PlanviewSubRegion::with('planviewRegion')->paginate(25);

        return View::make('admin.planview-subregions.index')
            ->with('subregions', $subregions);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.planview-subregions.form')
            ->with('title', 'Add New Subregion')
            ->with('action', 'admin.planview-subregions.store')
            ->with('method', 'post')
            ->with('subregion', new PlanviewSubRegion())
            ->with('regions', PlanviewRegion::optionsList());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $subregion = PlanviewSubRegion::create(Input::all());

        if ($subregion->save()) {
            return Redirect::route('admin.planview-subregions.show', $subregion->id)
                ->withMessage('The item was successfully created.');
        } else {
            return Redirect::route('admin.planview-subregions.create')
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($subregion->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  PlanviewSubRegion    $subregion
     * @return Response
     */
    public function show($subregion)
    {
        return View::make('admin.planview-subregions.form')
            ->with('title', "Edit Subregion: {$subregion->name}")
            ->with('action', ['admin.planview-subregions.update', $subregion->id])
            ->with('method', 'put')
            ->with('subregion', $subregion)
            ->with('regions', PlanviewRegion::optionsList());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PlanviewSubRegion    $subregion
     * @return Response
     */
    public function update($subregion)
    {
        if (Input::has('name')) {
            $subregion->name = Input::get('name');
        }

        if (Input::get('planview_region_id')) {
            $subregion->planview_region_id = Input::get('planview_region_id');
        }

        if ($subregion->save()) {
            return Redirect::route('admin.planview-subregions.show', $subregion->id)
                ->withMessage('The item was successfully created.');
        } else {
            return Redirect::route('admin.planview-subregions.show', $subregion->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($subregion->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  PlanviewSubRegion    $subregion
     * @return Response
     */
    public function destroy($subregion)
    {
        $subregion->delete();

        return Redirect::route('admin.planview-subregions.index')
            ->withMessage('The item has been deleted.');
    }


}
