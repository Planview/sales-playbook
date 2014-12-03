<?php

namespace Api;

use Competitor;
use Response;

class CompetitorsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Competitor::orderBy('name')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(Competitor::findOrFail($id));
    }


}
