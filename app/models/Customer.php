<?php

use LaravelBook\Ardent\Ardent;

/**
 * Planview customer object and related data
 */
class Customer extends Ardent
{

    /**
     * Only allow mass assignment of the name and whether name can be used
     *
     * @access  protected
     * @var     array   $fillable
     */
    protected $fillable = [
        'name',
        'can_use_name'
    ];

    /**
     * Ardent validation rules
     *
     * @access  public
     * @static
     * @var     array   $rules
     */
    public static $rules = [
        'name'                      => 'required|between:2,80',
        'can_use_name'              => 'required|boolean',
        'planview_sub_region_id'    => 'exists:planview_sub_regions,id',
        'operating_region_id'       => 'exists:operating_regions,id',
        'industry_id'               => 'exists:industries,id',
    ];

    /**
     * Set up relationships through Ardent
     *
     * @access  public
     * @static
     * @var     array   $relationsData
     */
    public static $relationsData = [
        'documents'         => [self::HAS_MANY, 'Document'],
        'planviewSubRegion' => [self::BELONGS_TO, 'PlanviewSubRegion'],
        'industry'          => [self::BELONGS_TO, 'Industry'],
        'operatingRegion'   => [self::BELONGS_TO, 'OperatingRegion'],
        'competitors'       => [self::BELONGS_TO_MANY, 'Competitor'],
        'markets'           => [self::BELONGS_TO_MANY, 'Market'],
    ];

    /**
     * Include the Planview region if we want verbose output
     *
     * @access  public
     * @return  \Illuminate\Database\Eloquent\Builder|static
     */
    public function planviewSubRegionVerbose()
    {
        return $this->planviewSubRegion()->with('planviewRegion');
    }

}
