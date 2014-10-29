<?php

class Document extends \Eloquent {
	protected $fillable = ['title', 'url'];

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
