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
        'ma_kho' => 'required|unique:khoa_warehouse_warehouses',
        'type' => 'required',
        'full_name' =>'required',
        'ngay_xuat_phieu' =>'required',
        'tai_kho' =>'required',
        'dia_diem' =>'required',
        'json_data' =>'required'
    ];

    /**
     * CONSTANT
     */
    const NHAP = 0;
    const XUAT = 1;

    public function getTypeOptions() {
        return [
            0 => 'Nhập',
            1 => 'Xuất'
        ];
    }

    public function getMaKhoOptions() {
        return Warehouse::orderBy('id','desc')->lists('ma_kho', 'ma_kho');
    }

    public function getTaiKhoOptions() {
        return Warehouse::orderBy('id','desc')->lists('tai_kho', 'tai_kho');
    }

    public function filterFields($fields, $context = null)
    {
        // $fields->theo->hidden = true; 
        // $fields->thoi_gian->hidden = true; 
        // $fields->cua->hidden = true;
        // $fields->dia_chi->hidden = true;
        
        // if ($fields->type->value == "0") {
        //     $fields->dia_chi->hidden = false;
        //     return;
        // }
        // if ($fields->type->value == "1") {
        //     $fields->theo->hidden = false; 
        //     $fields->thoi_gian->hidden = false; 
        //     $fields->cua->hidden = false;
        //     return;
        // }
    }
}
