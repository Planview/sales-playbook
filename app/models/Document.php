<?php

use LaravelBook\Ardent\Ardent;

class Document extends Ardent
{
    protected $fillable = ['title', 'url'];

    public static $rules = [
        'title' => 'required|between:2,80',
        'url'   => 'required|url',
        'document_type_id'  => 'exists:document_types,id',
        'customer_id'   => 'exists:customers,id'
    ];

    public function documentType()
    {
        return $this->belongsTo('DocumentType');
    }

    public function customer()
    {
        return $this->belongsTo('Customer')->with('markets');
    }

    public function customerVerbose()
    {
        return $this->customer()->with(
            'markets',
            'industry',
            'competitors',
            'operatingRegion',
            'planviewSubRegionVerbose'
        );
    }
}
