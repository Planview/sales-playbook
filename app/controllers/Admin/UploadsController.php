<?php

namespace Admin;

use Redirect;
use Input;
use View;
use Response;

use Upload;

class UploadsController extends \BaseController
{
    protected $permission = 'upload_files';

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
            ->with('method', 'post')
            ->with('fileHelp', null);
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
            ->with('method', 'put')
            ->with('fileHelp', 'Adding a file here will replace the current file');
    }

    public function update($upload) {
        if (Input::hasFile('file')) {
            $upload->replaceFromInput('file');
        }
            \Log::info($upload->errors()->all());

        $upload->name = Input::get('name', $upload->name);

        if ($upload->updateUniques()) {
            return Redirect::route('admin.uploads.show', $upload->id)
                ->withMessage('The file was successfully updated.');
        } else {

            return Redirect::route('admin.uploads.show', $upload->id)
                ->withError('An error occurred. See below for more information')
                ->withInput()
                ->withErrors($upload->errors());
        }
    }

    public function destroy($upload)
    {
        $upload->delete();

        return Redirect::route('admin.uploads.index')
            ->withMessage('The file has been deleted');
    }
}
