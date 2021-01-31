<?php namespace Khoa\Certificates\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKhoaCertificatesNienKhoa extends Migration
{
    public function up()
    {
        Schema::create('khoa_certificates_nien_khoa', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('khoa_certificates_nien_khoa');
    }
}
