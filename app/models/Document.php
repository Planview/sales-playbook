<?php

use LaravelBook\Ardent\Ardent;

/**
 * Document objects, mapped against customers
 */
class Document extends Ardent
{

    /**
     * Only allow mass assignment of the title and URL
     *
     * @access  protected
     * @var     array   $fillable
     */
    protected $fillable = [
        'title',
        'url',
        'document_type_id',
        'customer_id'
    ];

    /**
     * Ardent validation rules
     *
     * @access  public
     * @static
     * @var     array   $rules
     */
    public static $rules = [
        'title'             => 'required|between:2,80',
        'url'               => 'required|url',
        'document_type_id'  => 'exists:document_types,id',
        'customer_id'       => 'exists:customers,id'
    ];

    /**
     * Set up relationships through Ardent
     *
     * @access  public
     * @static
     * @var     array   $relationsData
     */
    public static $relationsData = [
        'documentType'      => [self::BELONGS_TO, 'DocumentType'],
        'customer'          => [self::BELONGS_TO, 'Customer']
    ];

    /**
     * Include all the customer data if we ask for verbose output
     *
     * @access  public
     * @return  \Illuminate\Database\Eloquent\Builder|static
     */
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
