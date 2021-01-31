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
            $table->string('full_name');
            $table->string('theo');
            $table->string('ngay');
            $table->string('thang');
            $table->string('nam');
            $table->string('cua');
            $table->text('nhap_tai_kho');
            $table->text('dia_diem');
            $table->text('json_data');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_warehouse_warehouses');
    }
}
