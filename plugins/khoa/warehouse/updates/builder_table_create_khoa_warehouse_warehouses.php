<?php namespace Khoa\Warehouse\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaWarehouseWarehouses extends Migration
{
    public function up()
    {
        Schema::create('khoa_warehouse_warehouses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('ma_kho');
            $table->smallInteger('type')->default(0)->comment('0: Xuat, 1: Nhap');
            $table->date('ngay_xuat_phieu');
            $table->text('tong_so_tien_viet_bang_chu');
            $table->string('so_chung_tu_goc_kem_theo');
            
            $table->text('json_data_nhap')->nullable();
            $table->text('json_data_xuat')->nullable();
            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_warehouse_warehouses');
    }
}
