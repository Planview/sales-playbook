<?php

class Industry extends \Eloquent {
	protected $fillable = ['name'];

    public function customers()
    {
        return $this->hasMany('Customer');
    }
}
