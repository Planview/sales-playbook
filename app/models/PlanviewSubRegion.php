<?php

class PlanviewSubRegion extends \Eloquent {
	protected $fillable = ['name', 'planview_region_id'];

    public function planviewRegion()
    {
        return $this->belongsTo('PlanviewRegion');
    }

    public function customers()
    {
        return $this->hasMany('Customer');
    }
}
