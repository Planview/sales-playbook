<?php

use LaravelBook\Ardent\Ardent;

/**
 * The Planview global region model, which contains PlanviewSubRegion
 * subregions
 */
class PlanviewRegion extends Ardent
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
        'planviewSubRegions'    => [self::HAS_MANY, 'PlanviewSubRegion']
    ];

    /**
     * Customers relationship through PlanviewSubRegion
     *
     * @access  public
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function customers()
    {
        return $this->hasManyThrough('Customer', 'PlanviewSubRegion');
    }

}
