<?php

use LaravelBook\Ardent\Ardent;

/**
 * The Planview sub-region that we are categorizing by, belonging to a
 * PlanviewRegion
 */
class PlanviewSubRegion extends Ardent
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
        'name'                  => 'required|between:2,80',
        'planview_region_id'    => 'exists:planview_regions,id'
    ];

    /**
     * Set up relationships through Ardent
     *
     * @access  public
     * @static
     * @var     array   $relationsData
     */
    public static $relationsData = [
        'planviewRegion'    => [self::BELONGS_TO, 'PlanviewRegion'],
        'customers'         => [self::HAS_MANY, 'Customer']
    ];

}
