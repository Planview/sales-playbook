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

    /**
     * Build an options list for a select box
     *
     * @access  public
     * @static
     * @return  array   All objects as id => name
     */
    public static function optionsList()
    {
        $list = array();

        foreach (self::all() as $region) {
            $list[$region->id] = $region->name;
        }

        return $list;
    }

    /**
     * Setup a full list of subregions categorized by region
     *
     * @return  array   Nested array of subregions
     */
    public static function optionsListSubregions()
    {
        $list = array();

        foreach (self::all() as $region) {
            $subList = array();

            foreach ($region->planviewSubRegions as $subregion) {
                $subList[$subregion->id] = $subregion->name;
            }

            $list[$region->name] = $subList;
        }

        return $list;
    }

    /**
     * Hook before delete, deletes subregions
     *
     * @param  PlanviewRegion   $region     The region being deleted
     * @return boolean          Return true for continued process
     */
    public function beforeDelete($region)
    {
        foreach ($region->planviewSubRegions as $subregion) {
            $subregion->delete();
        }

        return true;
    }
}
