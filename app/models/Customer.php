<?php

class Customer extends \Eloquent {
	protected $fillable = [
        'name',
        'can_use_name',
        'planview_sub_region_id',
        'operating_region_id',
        'industry_id'
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
