<?php

class PlanviewRegion extends \Eloquent {
    protected $fillable = ['name'];

    public function planviewSubRegions()
    {
        return $this->hasMany('PlanviewSubRegion');
    }

    public function customers()
    {
        return $this->hasManyThrough('Customer', 'PlanviewSubRegion');
    }
}
