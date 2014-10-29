<?php

class OperatingRegion extends \Eloquent {
	protected $fillable = ['name'];

    public function customers()
    {
        return $this->hasMany('Customer');
    }
}
