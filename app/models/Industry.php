<?php

use LaravelBook\Ardent\Ardent;

class Industry extends Ardent
{
    protected $fillable = ['name'];

    public static $rules = [
        'name'  => 'required|between:2,80'
    ];

    public function customers()
    {
        return $this->hasMany('Customer');
    }
}
