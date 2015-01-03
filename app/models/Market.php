<?php

use LaravelBook\Ardent\Ardent;

/**
 * Planview markets
 */
class Market extends Ardent
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

    /**
     * Return an array to be used as options in a select
     *
     * @return array Items as id => name
     */
    public static function optionsList()
    {
        $list = array();

        foreach (self::all() as $market) {
            $list[$market->id] = $market->name;
        }

        return $list;
    }

    /**
     * Clean up relationship data on delete
     *
     * @param   Market  $market     The object being deleted
     * @return  boolean             Returns true
     */
    public function beforeSave($market)
    {
        DB::table('customer_market')
            ->where('market_id', $market->id)
            ->delete();

        return true;
    }

}
