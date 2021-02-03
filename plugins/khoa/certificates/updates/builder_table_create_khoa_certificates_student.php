<?php namespace Khoa\Certificates\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaCertificatesStudent extends Migration
{
    public function up()
    {
        Schema::create('khoa_certificates_student', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('ho_ten');
            $table->date('dob')->nullable();
            $table->string('cmnd')->nullable();
            $table->text('que_quan')->nullable();
            $table->string('noi_sinh')->nullable();
            $table->string('noi_cap')->nullable();
            $table->string('nghiep_vu')->nullable();
            $table->string('ngoai_ngu')->nullable();
            $table->string('kien_thuc')->nullable();
            $table->string('slug_nganh')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('nhomnganh_id')->unsigned();
            $table->integer('nienkhoa_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_certificates_student');
    }
}
