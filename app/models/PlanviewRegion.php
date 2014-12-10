<?php

use LaravelBook\Ardent\Ardent;

class PlanviewRegion extends Ardent
{
    protected $fillable = ['name'];

    public static $rules = [
        'name'  => 'required|between:2,80'
    ];

    public function planviewSubRegions()
    {
        return $this->hasMany('PlanviewSubRegion');
    }

    public function customers()
    {
        return $this->hasManyThrough('Customer', 'PlanviewSubRegion');
    }
}
