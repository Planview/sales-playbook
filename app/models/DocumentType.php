<?php

use LaravelBook\Ardent\Ardent;

class DocumentType extends Ardent
{
    protected $fillable = ['name'];

    public static $rules = [
        'name'  => 'required|between:2,80'
    ];

    public function documents()
    {
        return $this->hasMany('Document');
    }
}
