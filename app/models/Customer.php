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
        'can_use_name',
        'planview_sub_region_id',
        'operating_region_id',
        'industry_id'
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

    /**
     * Clean up relationship data on delete
     *
     * @param   Customer    $customer   The object being deleted
     * @return  boolean                 Returns true
     */
    public function beforeDelete($customer)
    {
        foreach ($customer->documents as $document) {
            $document->delete();
        }

        DB::table('competitor_customer')
            ->where('customer_id', $customer->id)
            ->delete();

        DB::table('customer_market')
            ->where('customer_id', $customer->id)
            ->delete();

        return true;
    }

    /**
     * Get the ID's of all the markets
     *
     * @return  array   All the ID's
     */
    public function marketsById()
    {
        return $this->relatedById('markets');
    }

    /**
     * Get the ID's of all the competitors
     *
     * @return  array   All the ID's
     */
    public function competitorsById()
    {
        return $this->relatedById('competitors');
    }

    /**
     * Abstract getting the ID's of related objects
     *
     * @param   string  $name   The property to iterate over
     * @return  array           All the item ID's in an array
     */
    protected function relatedById($name)
    {
        $list = array();

        foreach ($this->$name as $item) {
            $list[] = $item->id;
        }

        return $list;
    }

    public static function optionsList()
    {
        $list = array();

        foreach (self::orderBy('name', 'asc')->get() as $customer) {
            $list[$customer->id] = $customer->name;
        }

        return $list;
    }

}
