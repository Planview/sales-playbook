<?php

use LaravelBook\Ardent\Ardent;

/**
 * Competitor object, related to the customers where Planview was in competition
 */
class Competitor extends Ardent
{

    /**
     * Only allow mass assignment of the name
     *
     * @access  protected
     * @var     array   $fillable
     */
    protected $fillable = ['name'];

    /**
     * Ardent validation rules
     *
     * @access  public
     * @static
     * @var     array   $rules
     */
    public static $rules = [
        'name'  => 'required|between:2,80'
    ];

    /**
     * Set up relationships through Ardent
     *
     * @access  public
     * @static
     * @var     array   $relationsData
     */
    public static $relationsData = [
        'customers' => [self::BELONGS_TO_MANY, 'Customer']
    ];

}
