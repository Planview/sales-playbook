<?php

use LaravelBook\Ardent\Ardent;

class Customer extends Ardent
{
    protected $fillable = [
        'name',
        'can_use_name',
        'planview_sub_region_id',
        'operating_region_id',
        'industry_id'
    ];

    public static $rules = [
        'name'                  => 'required|between:2,80',
        'can_use_name'          => 'required|boolean',
        'planview_sub_region_id'    => 'exists:planview_sub_regions,id',
        'operating_region_id'   => 'exists:operating_regions,id',
        'industry_id'           => 'exists:industries,id',
    ];

    public function documents()
    {
        return $this->hasMany('Document');
    }

    public function planviewSubRegion()
    {
        return $this->belongsTo('PlanviewSubRegion');
    }

    public function industry()
    {
        return $this->belongsTo('Industry');
    }

    public function operatingRegion()
    {
        return $this->belongsTo('operatingRegion');
    }

    public function competitors()
    {
        return $this->belongsToMany('Competitor');
    }

    public function markets()
    {
        return $this->belongsToMany('Market');
    }

    public function planviewSubRegionVerbose()
    {
        return $this->planviewSubRegion()->with('planviewRegion');
    }
}
