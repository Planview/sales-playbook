<?php

use LaravelBook\Ardent\Ardent;

/**
 * Customer operating regions
 */
class OperatingRegion extends Ardent
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
        'customers' => [self::HAS_MANY, 'Customer']
    ];

    /**
     * Return an array to be used as options in a select
     *
     * @return array Items as id => name
     */
    public static function optionsList()
    {
        $list = array();

        foreach (self::all() as $region) {
            $list[$region->id] = $region->name;
        }

        return $list;
    }

}
