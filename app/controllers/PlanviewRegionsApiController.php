<?php

class PlanviewRegionsApiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(PlanviewRegion::with('planviewSubRegions')->get());
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
