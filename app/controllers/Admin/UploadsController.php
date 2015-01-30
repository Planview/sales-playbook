<?php

namespace Admin;

use Redirect;
use Input;
use View;
use Response;

use Upload;

class UploadsController extends \BaseController
{
    public function index()
    {
        $uploads = Upload::paginate(25);

        return View::make('admin.uploads.index')
            ->with('uploads', $uploads);
    }

    public function create()
    {
        return View::make('admin.uploads.form')
            ->with('title', 'Add New Upload')
            ->with('upload', new Upload())
            ->with('action', 'admin.uploads.store')
            ->with('method', 'post');
    }

    public function store()
    {
        $upload = Upload::fromInput('file', Input::get('name'));

        if ($upload->save()) {
            return Redirect::route('admin.uploads.show', $upload->id)
                ->withMessage('The file was successfully saved.');
        } else {
            return Redirect::route('admin.uploads.create')
                ->withError('An error occurred. See below for more information')
                ->withInput()
                ->withErrors($upload->errors());
        }
    }

    public function show($upload) {
        return View::make('admin.uploads.form')
            ->with('title', 'Edit: ' . $upload->name)
            ->with('upload', $upload)
            ->with('action', ['admin.uploads.update', $upload->id])
            ->with('method', 'put');
    }
}
