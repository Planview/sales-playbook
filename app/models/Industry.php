<?php

use LaravelBook\Ardent\Ardent;

/**
 * Customer industries for relationships
 */
class Industry extends Ardent
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

        foreach (self::all() as $industry) {
            $list[$industry->id] = $industry->name;
        }

        return $list;
    }

    /**
     * Clean up relationships on delete
     *
     * @return  boolean     Returns true
     */
    public function beforeDelete()
    {
        foreach ($this->customers as $customer) {
            $customer->delete();
        }

        return true;
    }

}
