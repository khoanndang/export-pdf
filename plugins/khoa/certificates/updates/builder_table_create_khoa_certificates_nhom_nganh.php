<?php namespace Khoa\Certificates\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaCertificatesNhomNganh extends Migration
{
    public function up()
    {
        Schema::create('khoa_certificates_nhom_nganh', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('nghiep_vu')->nullable();
            $table->string('ngoai_ngu')->nullable();
            $table->string('kien_thuc')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_certificates_nhom_nganh');
    }
}
