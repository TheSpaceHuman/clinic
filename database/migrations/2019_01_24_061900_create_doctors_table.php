<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('doctors', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();
      $table->string('name');
      $table->string('slug');
      $table->string('city');
      $table->string('image')->nullable();
      $table->string('specialization');
    });
  }


  /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
