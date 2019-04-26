<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('services', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();
      $table->string('title');
      $table->string('slug');
      $table->integer('code');
      $table->string('status')->nullable();
      $table->integer('time');
      $table->string('priority')->nullable();
      $table->integer('price');
      $table->integer('category_id');
//      $table->integer('doctor_id');
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
