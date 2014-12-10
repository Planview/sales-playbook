<?php

use LaravelBook\Ardent\Ardent;

class PlanviewSubRegion extends Ardent
{
    protected $fillable = [
        'name',
        'planview_region_id'
    ];

    public static $rules = [
        'name'  => 'required|between:2,80',
        'planview_region_id'    => 'exists:planview_regions,id'
    ];

    public function planviewRegion()
    {
        return $this->belongsTo('PlanviewRegion');
    }

    public function customers()
    {
        return $this->hasMany('Customer');
    }
}
