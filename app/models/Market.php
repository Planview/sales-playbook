<?php

class Market extends \Eloquent {
	protected $fillable = ['name'];

    public function customers()
    {
        return $this->belongsToMany('Customer');
    }
}
