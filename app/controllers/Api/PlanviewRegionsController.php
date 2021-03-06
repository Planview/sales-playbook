<?php

namespace Api;

use PlanviewRegion;
use Response;

class PlanviewRegionsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(PlanviewRegion::orderBy('name')->with('planviewSubRegions')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(PlanviewRegion::with('planviewSubRegions')->findOrFail($id));
    }


}
