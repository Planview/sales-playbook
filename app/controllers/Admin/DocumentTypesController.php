<?php

namespace Admin;

use \View;
use \Response;
use \Input;
use \Redirect;

use \DocumentType;

class DocumentTypesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $types = DocumentType::paginate(25);

        return View::make('admin.document-types.index')
            ->with('types', $types);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.document-types.form')
            ->with('title', 'Add New Document Type')
            ->with('action', 'admin.document-types.store')
            ->with('method', 'post')
            ->with('type', new DocumentType());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $type = DocumentType::create(Input::all());

        if ($type->save()) {
            return Redirect::route('admin.document-types.show', $type->id)
                ->withMessage('The new document type has been created.');
        } else {
            return Redirect::route('admin.document-types.create')
                ->withError('The document type could not be saved. ' .
                    'See below for more information.')
                ->withErrors($type->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  DocumentType     $type
     * @return Response
     */
    public function show($type)
    {
        return View::make('admin.document-types.form')
            ->with('title', "Edit Type: {$type->name}")
            ->with('action', ['admin.document-types.update', $type->id])
            ->with('method', 'put')
            ->with('type', $type);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DocumentType     $type
     * @return Response
     */
    public function update($type)
    {
        $type->name = Input::get('name');
        $type->internal_only = Input::get('internal_only', 0);

        if ($type->save()) {
            return Redirect::route('admin.document-types.show', $type->id)
                ->withMessage('The type has been successfully updated.');
        } else {
            return Redirect::route('admin.document-types.show', $type->id)
                ->withError('The document type could not be saved. ' .
                    'See below for more information.')
                ->withErrors($type->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  DocumentType     $type
     * @return Response
     */
    public function destroy($type)
    {
        $type->delete();

        return Redirect::route('admin.document-types.index')
            ->withMessage('The document type has been deleted.');
    }


}
