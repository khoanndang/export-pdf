<?php namespace Khoa\Certificates\Models;

use Model;

/**
 * Model
 */
class Nienkhoa extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_certificates_nien_khoa';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'start' => 'required',
        'end' => 'required',
    ];
}
