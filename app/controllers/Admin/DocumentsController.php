<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \Document;

class DocumentsController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /admin/documents
     *
     * @return Response
     */
    public function index()
    {
        $documents = Document::orderBy('title', 'asc')->paginate(25);

        return View::make('admin.documents.index')
            ->with('documents', $documents);
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin/documents/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.documents.form')
            ->with('title', 'Add New Document')
            ->with('action', 'admin.documents.store')
            ->with('method', 'post')
            ->with('document', new Document());
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin/documents
     *
     * @return Response
     */
    public function store()
    {
        $document = new Document(Input::all());

        if ($document->save()) {
            return Redirect::route('admin.documents.show', $document->id)
                ->withMessage('The item has been successfully created.');
        } else {
            return Redirect::route('admin.documents.create')
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($document->errors())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     * GET /admin/documents/{id}
     *
     * @param  Document  $document
     * @return Response
     */
    public function show($document)
    {
        return View::make('admin.documents.form')
            ->with('title', "Edit: {$document->title}")
            ->with('action', ['admin.documents.update', $document->id])
            ->with('method', 'put')
            ->with('document', $document);
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin/documents/{id}
     *
     * @param  Document  $document
     * @return Response
     */
    public function update($document)
    {
        $document->fill(Input::all());

        if ($document->save()) {
            return Redirect::route('admin.documents.show', $document->id)
                ->withMessage('The item has been successfully updated.');
        } else {
            return Redirect::route('admin.documents.show', $document->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($document->errors())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin/documents/{id}
     *
     * @param  Document  $document
     * @return Response
     */
    public function destroy($document)
    {
        $document->delete();

        return Redirect::route('admin.documents.index')
            ->withMessage('The item has been deleted.');
    }

}
