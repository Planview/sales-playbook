<?php

namespace Admin;

use Response;
use Redirect;
use View;
use Input;

use Kickoff;
use Kickoff\Page;

class KickoffPagesController extends \BaseController
{
    protected $permission = 'manage_kickoffs';

    public function index($kickoff)
    {
        return View::make('admin.kickoffs.pages.index')
            ->with('kickoff', $kickoff)
            ->with('pages', $kickoff->pages);
    }

    public function create($kickoff)
    {
        return View::make('admin.kickoffs.pages.form')
            ->with('kickoff', $kickoff)
            ->with('page', new Page())
            ->with('title', "Create New Page for {$kickoff->name} Sales Kickoff")
            ->with('action', ['admin.kickoffs.pages.store', $kickoff->id])
            ->with('method', 'post');
    }

    public function store($kickoff)
    {
        $page = new Page(Input::all());

        $page->slug = Input::get('slug');

        $page->kickoff_id = $kickoff->id;

        if ($page->save()) {
            return Redirect::route('admin.kickoffs.pages.show', [$kickoff->id, $page->id])
                ->withMessage('The item was created successfully.');
        } else {
            return Redirect::route('admin.kickoffs.pages.create', $kickoff->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($page->errors())
                ->withInput();
        }
    }

    public function show($kickoff, $page)
    {
        return View::make('admin.kickoffs.pages.form')
            ->with('kickoff', $kickoff)
            ->with('page', $page)
            ->with('title', "{$kickoff->name} Sales Kickoff: <code>{$page->slug}</code>")
            ->with('action', ['admin.kickoffs.pages.update', $kickoff->id, $page->id])
            ->with('method', 'put');
    }

    public function update($kickoff, $page)
    {
        $page->fill(Input::all());

        if ($page->save()) {
            return Redirect::route('admin.kickoffs.pages.show', [$kickoff->id, $page->id])
                ->withMessage('The item was updated successfully.');
        } else {
            return Redirect::route('admin.kickoffs.pages.show', [$kickoff->id, $page->id])
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($page->errors())
                ->withInput();
        }
    }
}
