<?php

use LaravelBook\Ardent\Ardent;

class Market extends Ardent
{
	protected $fillable = ['name'];

    public static $rules = [
        'name'  => 'required|between:2,80'
    ];

    public function customers()
    {
        return $this->belongsToMany('Customer');
    }
}
