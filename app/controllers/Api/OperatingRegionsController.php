<?php

namespace Api;

use OperatingRegion;
use Response;

class OperatingRegionsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(OperatingRegion::orderBy('name')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(OperatingRegion::findOrFail($id));
    }


}
