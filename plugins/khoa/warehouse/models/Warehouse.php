<?php namespace Khoa\Warehouse\Models;

use Model;
use Carbon\Carbon;
use Khoa\Product\Models\Product;

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
        // 'ma_kho' => 'required|unique:khoa_warehouse_warehouses',
        'type' => 'required',
        'ngay_xuat_phieu' =>'required',
        // 'tong_so_tien_viet_bang_chu' => 'required',
        'so_chung_tu_goc_kem_theo' => 'required',
        'ma_phieu' => 'unique:khoa_warehouse_warehouses'
    ];

    public $belongsTo = [
        'product' => ['Khoa\Product\Models\Product', 'key' => 'ma_so', 'otherKey' => 'ma_so']
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
        // dd($fields->json_data_nhap);
        // if ($fields->json_data_nhap) {
        //     foreach ($fields->json_data_nhap as $line) {
        //         $fields->{'json_data_nhap[ten_nhan_hieu]'}->value = $line;
        //     }
            
        // }
        // dd($this->ma_so);
        // if (empty($this->ma_so))
        //     return;
    }

    public function beforeCreate() {
        // dd($this->json_data_nhap);
        //generate ma_phieu
        $time = $this->ngay_xuat_phieu;

        $year = Carbon::parse($time)->format('y');
        $month = Carbon::parse($time)->format('m');

        $firstDayOfMonth = Carbon::parse($time)->firstOfMonth();
        $lastDayOfMonth = Carbon::parse($time)->lastOfMonth();

        $all_data = Warehouse::whereBetween('ngay_xuat_phieu',[$firstDayOfMonth, $lastDayOfMonth]);

        if ($this->type == "0") {
            $lp = "XK";
            $type = Warehouse::XUAT;
        } elseif ($this->type == "1") {
            $lp = "NK";
            $type = Warehouse::NHAP;
        }
        $all_data = $all_data->where('type',$type)->count();
        $all_data = $all_data + 1;

        if ($all_data >= 1 && $all_data <= 9) {
            $all_data = "000$all_data";
        } elseif ($all_data >= 10 && $all_data <= 99) {
            $all_data = "00$all_data";
        } elseif ($all_data >= 100 && $all_data <= 999) {
            $all_data = "0$all_data";
        } else {
            $all_data = $all_data;
        }
        
        $ma_phieu = "$lp-$year$month-$all_data";
        
        $this->ma_phieu = $ma_phieu;
        
    }

    public function beforeSave() {
        $total_don_gia = 0;
        $total_thanh_tien = 0;

        //Nhap - xuat
        if ($this->type == "1") {
            $all_json_data = $this->json_data_nhap;
        } elseif ($this->type == "0") {
            $all_json_data = $this->json_data_xuat;
        }

        $arr = [];
        $arr_all = [];
        if (count($all_json_data) > 0) {
            foreach ($all_json_data as $json_data) {
                $total_don_gia = $total_don_gia + intval($json_data['don_gia']);
                $json_data['thanh_tien'] = intval($json_data['don_gia']) * intval($json_data['so_luong_nhap']);
                $total_thanh_tien = $total_thanh_tien + intval($json_data['thanh_tien']);

                //replace data thanh_tien
                $array['thanh_tien'] = $total_thanh_tien;
                array_replace($json_data, $arr);

                $arr_all[] = $json_data;
            }

            if ($this->type == "1") {
                $this->json_data_nhap = $arr_all;
            } elseif ($this->type == "0") {
                $this->json_data_xuat = $arr_all;
            }
        }
        
        $this->total_don_gia = $total_don_gia;
        $this->total_thanh_tien = $total_thanh_tien;
    }

    public function getMaSoOptions() {
        return Product::all()->lists('ma_so','ma_so');
    }

    public function getTenNhanHieuOptions($value, $data) {
        $product = isset($data->product) ? $data->product : null;
        if ($product != null) {
            return Product::where('ma_so', $product)->lists('ten_nhan_hieu', 'ten_nhan_hieu');
        }
        
        return ['',''];
    }

    // public function getNhaCungCapOptions($value, $data) {
    //     $product = isset($data->product) ? $data->product : null;
    //     if ($product != null) {
    //         return Product::where('ma_so', $product)->lists('nha_cung_cap', 'nha_cung_cap');
    //     }
        
    //     return ['',''];
    // }

    public function getDonViTinhOptions($value, $data) {
        $product = isset($data->product) ? $data->product : null;
        if ($product != null) {
            return Product::where('ma_so', $product)->lists('don_vi_tinh', 'don_vi_tinh');
        }
        
        return ['',''];
    }

    // public function getDonGiaOptions($value, $data) {
    //     $product = isset($data->product) ? $data->product : null;
    //     if ($product != null) {
    //         return Product::where('ma_so', $product)->lists('don_gia', 'don_gia');
    //     }
        
    //     return ['',''];
    // }
}
