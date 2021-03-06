<?php

namespace Api;

use DocumentType;
use Response;

class DocumentTypesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(DocumentType::orderBy('name')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(DocumentType::findOrFail($id));
    }


}
