<?php

namespace Kickoff;

use LaravelBook\Ardent\Ardent;
use View;
use Kickoff;

class Page extends Ardent
{
    protected $table = 'kickoff_pages';

    protected $fillable = ['html', 'scripts', 'styles'];

    public static $rules = [
        'slug'          => 'required|alpha_dash|between:2,80',
        'kickoff_id'    => 'required|exists:kickoffs,id',
        'html'          => 'required'
    ];

    public static $relationsData = [
        'kickoff' => [self::BELONGS_TO, 'Kickoff', 'foreignKey' => 'id']
    ];

    public function buildPage() {
        $kickoff = Kickoff::find($this->kickoff_id);

        return View::make($kickoff->layout ?: 'kickoffs.default')
            ->with('menu', $kickoff->menu)
            ->with('kickoff', $kickoff)
            ->with('page', $this);
    }
}
