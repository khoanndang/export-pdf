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

    protected $jsonable = ['json_data_nhap','json_data_xuat'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'ma_kho' => 'required|unique:khoa_warehouse_warehouses',
        'type' => 'required',
        'ngay_xuat_phieu' =>'required',
        'tong_so_tien_viet_bang_chu' => 'required',
        'so_chung_tu_goc_kem_theo' => 'required'
    ];

    /**
     * CONSTANT
     */
    const XUAT = 0;
    const NHAP = 1;

    public function getTypeOptions() {
        return [
            0 => 'Xuất',
            1 => 'Nhập'
        ];
    }

    public function getMaKhoOptions() {
        return Warehouse::orderBy('id','desc')->lists('ma_kho', 'ma_kho');
    }

    public function filterFields($fields, $context = null)
    {
        // $fields->json_data_nhap->hidden = true; 
        // $fields->json_data_xuat->hidden = true; 
        
        // if ($fields->type->value == "0") {
        //     $fields->json_data_nhap->hidden = false;
        //     return;
        // }
        // if ($fields->type->value == "1") {
        //     $fields->json_data_xuat->hidden = false;
        //     return;
        // }
    }
}
