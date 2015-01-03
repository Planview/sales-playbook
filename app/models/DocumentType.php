<?php

use LaravelBook\Ardent\Ardent;

/**
 * Document types for categorization
 */
class DocumentType extends Ardent
{

    /**
     * Only allow mass assignment of the name and whether document is confidential
     *
     * @access  protected
     * @var     array   $fillable
     */
    protected $fillable = [
        'name',
        'internal_only'
    ];

    /**
     * Ardent validation rules
     *
     * @access  public
     * @static
     * @var     array   $rules
     */
    public static $rules = [
        'name'          => 'required|between:2,80',
        'internal_only' => 'required|boolean'
    ];

    /**
     * Set up relationships through Ardent
     *
     * @access  public
     * @static
     * @var     array   $relationsData
     */
    public static $relationsData = [
        'documents' => [self::HAS_MANY, 'Document']
    ];

    /**
     * Clean up relationships on delete
     *
     * @param   DocumentType    $type   The object being deleted
     * @return  boolean         Returns true
     */
    public function beforeDelete($type)
    {
        foreach ($type->documents as $document) {
            $document->delete();
        }

        return true;
    }
}
