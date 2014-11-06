<?php

namespace Api;

use Document;
use Response;

class DocumentsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Document::with(
            'customerVerbose',
            'documentType'
        )->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(Document::with(
            'customerVerbose',
            'documentType'
        )->findOrFail($id));
    }

}
