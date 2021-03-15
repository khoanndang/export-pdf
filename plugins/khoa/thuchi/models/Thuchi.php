<?php namespace Khoa\Thuchi\Models;

use Model;
use Khoa\Certificates\Models\Student;
use Carbon\Carbon;

/**
 * Model
 */
class Thuchi extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_thuchi_thuchis';

    /**
     * @var array Validation rules
     */
    public $rules = [
        // 'thuctapsinh_id' => 'required',
        'full_name' => 'required',
        'so_tien' => 'required',
        'viet_bang_chu' => 'required',
        'address' => 'required',
        'ngay_xuat_phieu' => 'required',
        'type' => 'required',
    ];

    /**
     * Relation
     */
    public $belongsTo = [
        'nienkhoa' => [
            'Khoa\Certificates\Models\Nienkhoa',
            'order' => 'id desc'
        ],
        'thuctapsinh' => [
            'Khoa\Certificates\Models\Student',
            'order' => 'id desc'
        ],
    ];

    /**
     * CONSTANT
     */
    const THU = 0;
    const CHI = 1;

    /**
     * Function
     */
    public function getThuctapsinhIdOptions()
    {
        $array = [];
        if (isset($this->nienkhoa)) {
            $data = Student::where('nienkhoa_id',$this->nienkhoa['id'])->orderBy('id', 'desc')->get();
            foreach ($data as $item) {
                $array[$item->id] = $item->ho_ten . ' - ' . $item->cmnd;
            }
            return $array;
        } else {
            return $array;
        }
        
    }

    public function beforeCreate() {
        // $student = Student::find($this->thuctapsinh_id);
        // $this->full_name = $student->ho_ten;
        // $this->cmnd = $student->cmnd;

        //generate ma_phieu
        $year = Carbon::today()->format('y');
        $month = Carbon::today()->format('m');
        $now = Carbon::now();
        $firstDayOfMonth = Carbon::now()->firstOfMonth();
        $all_data = Thuchi::whereBetween('created_at',[$firstDayOfMonth, $now]);
        if ($this->type == "0") {
            $lp = "PT";
            $type = Thuchi::THU;
        } elseif ($this->type == "1") {
            $lp = "PC";
            $type = Thuchi::CHI;
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

    public function getTypeOptions() {
        return [
            0 => 'Thu',
            1 => 'Chi'
        ];
    }
}
