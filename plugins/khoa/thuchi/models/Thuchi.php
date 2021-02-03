<?php namespace Khoa\Thuchi\Models;

use Model;
use Khoa\Certificates\Models\Student;

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
        'thuctapsinh_id' => 'required',
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

    public function beforeSave() {
        $student = Student::find($this->thuctapsinh_id);
        $this->full_name = $student->ho_ten;
        $this->cmnd = $student->cmnd;
    }

    public function getTypeOptions() {
        return [
            0 => 'Thu',
            1 => 'Chi'
        ];
    }
}
