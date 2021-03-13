<?php namespace Khoa\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaProductProducts extends Migration
{
    public function up()
    {
        Schema::create('khoa_product_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('ma_so');
            $table->string('ten_nhan_hieu')->nullable();
            $table->string('nha_cung_cap')->nullable();
            $table->string('don_vi_tinh')->nullable();
            $table->double('don_gia', 10, 0)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_product_products');
    }
}
