<?php

use LaravelBook\Ardent\Ardent;

class Kickoff extends Ardent
{
    protected $fillable = ['layout', 'menu'];

    public static $rules = [
        'name'      => 'required|integer|between:2000,3000',
        'active'    => 'boolean',
    ];

    public static $relationsData = [
        'pages' => [self::HAS_MANY, 'Kickoff\\Page', 'foreignKey' => 'kickoff_id']
    ];

    public static function getActive() {
        return self::where('active', true)->first();
    }

    public static function clearActive() {
        $active = self::getActive();

        if (null === $active) return true;

        $active->active = false;
        return $active->save();
    }

    public function pageBySlug($slug) {
        return $this->pages()->where('slug', $slug)->first();
    }
}
