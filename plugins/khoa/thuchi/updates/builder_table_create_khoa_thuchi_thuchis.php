<?php namespace Khoa\Thuchi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaThuchiThuchis extends Migration
{
    public function up()
    {
        Schema::create('khoa_thuchi_thuchis', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('ma_phieu')->nullable();
            $table->date('ngay_xuat_phieu');
            $table->integer('nienkhoa_id')->unsigned()->nullable();
            $table->integer('thuctapsinh_id')->unsigned()->nullable();
            $table->string('full_name');
            $table->string('cmnd');
            $table->text('address');
            $table->text('ly_do');
            $table->string('kem_theo')->nullable();
            $table->smallInteger('type')->default(0)->comment('0: Thu, 1: Chi');
            $table->double('so_tien', 10, 0)->default(0);
            $table->string('viet_bang_chu');
            $table->smallInteger('payment_type')->default(0)->comment('0: CHUYỂN KHOẢN, 1: TIỀN MẶT');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_thuchi_thuchis');
    }
}
