<?php namespace Khoa\Warehouse\Models;

use Model;

/**
 * Model
 */
class Warehouse extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_warehouse_warehouses';

    protected $jsonable = ['json_data'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        ''
    ];
}
