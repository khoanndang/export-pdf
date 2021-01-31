<?php namespace Khoa\Certificates\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaCertificatesNhomNganhNienKhoa extends Migration
{
    public function up()
    {
        Schema::create('khoa_certificates_nhom_nganh_nien_khoa', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('nhomnganh_id')->unsigned();
            $table->integer('nienkhoa_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_certificates_nhom_nganh_nien_khoa');
    }
}
