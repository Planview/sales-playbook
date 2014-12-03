<?php

namespace Api;

use Market;
use Response;

class MarketsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Market::orderBy('name')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(Market::findOrFail($id));
    }


}
