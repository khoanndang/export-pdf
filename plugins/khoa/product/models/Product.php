<?php namespace Khoa\Product\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'khoa_product_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'ten_nhan_hieu' => 'required',
        'don_vi_tinh' => 'required',
        'don_gia' => 'required',
    ];

    public function beforeCreate() {
        //create order record
        $ma_so = $this->quickRandom(6); //generate tracking number
        do {
            $ma_so = $this->quickRandom(6); //generate tracking number
        } while (Product::where('ma_so',$ma_so)->count() > 0);
        $this->ma_so = $ma_so;
    }

    public function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }


}
