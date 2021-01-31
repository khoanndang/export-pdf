<?php namespace Khoa\Certificates\Models;

use Model;

/**
 * Model
 */
class Nhomnganh extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_certificates_nhom_nganh';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'nienkhoa' => 'required',
    ];

    /**
     * Relation
     */
    public $belongsToMany = [
        'nienkhoa' => [
            'Khoa\Certificates\Models\Nienkhoa',
            'table' => 'khoa_certificates_nhom_nganh_nien_khoa',
            'key' => 'nhomnganh_id',
            'otherKey' => 'nienkhoa_id',
        ],
    ];
}
