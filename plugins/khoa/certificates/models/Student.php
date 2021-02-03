<?php namespace Khoa\Certificates\Models;

use Model;
use Khoa\Certificates\Models\Nienkhoa;
use Khoa\Certificates\Models\Nhomnganh;

/**
 * Model
 */
class Student extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_certificates_student';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'nienkhoa' => 'required',
        'ho_ten' => 'required',
        'nhomnganh_id' => 'required',
    ];

    /**
     * Relation
     */
    public $belongsTo = [
        'nienkhoa' => [
            'Khoa\Certificates\Models\Nienkhoa',
            'order' => 'id desc'
        ],
        'nhomnganh' => 'Khoa\Certificates\Models\Nhomnganh',
    ];

    /**
     * Function
     */

    public function getNhomnganhIdOptions()
    {
        $nienkhoa = $this->nienkhoa;
        if (isset($nienkhoa)) {
            $nhom_nganh = Nhomnganh::whereHas('nienkhoa', function($q) use ($nienkhoa){
                $q->where('nienkhoa_id','=',$nienkhoa->id);
            });

            $nhom_nganh = $nhom_nganh->orderBy('id','desc')->get()->lists('name','id');
            return $nhom_nganh;
        } else {
            return [];
        }

    }


    public function getNienkhoaOptions()
    {
        return Nienkhoa::orderBy('id','desc')->lists('name', 'id');
    }

    public function getNhomnganhOptions($scopes = null)
    {
        if (!empty($scopes['nienkhoa']->value)) {
            $nienkhoa_id = array_keys($scopes['nienkhoa']->value);
            $result = Nhomnganh::whereHas('nienkhoa', function($q) use ($nienkhoa_id){
                $q->where('nienkhoa_id','=',$nienkhoa_id);
            });
            return $result->lists('name', 'id');
        } else {
            return Nhomnganh::orderBy('id','desc')->lists('name', 'id');
        }
    }

    public function beforeSave() {
        $nhom_nganh = Nhomnganh::find($this->nhomnganh_id);
        $this->nghiep_vu = $nhom_nganh->nghiep_vu;
        $this->ngoai_ngu = $nhom_nganh->ngoai_ngu;
        $this->kien_thuc = $nhom_nganh->kien_thuc;
        $this->slug_nganh = $nhom_nganh->slug;
        $this->start = $this->nienkhoa->start;
        $this->end = $this->nienkhoa->end;
    }
}
