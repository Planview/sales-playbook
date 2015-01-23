<?php

use LaravelBook\Ardent\Ardent;

class File extends Ardent
{
    public static $rules = [
        'name'      => 'required',
        'directory' => 'required',
        'filename'  => 'required|unique:files',
        'mime'      => 'required'
    ];

    protected $fillable = [
        'name', 'filename'
    ];
}
