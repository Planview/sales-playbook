<?php

class DocumentType extends \Eloquent {
	protected $fillable = [];

    public function documents()
    {
        return $this->hasMany('Document');
    }
}
