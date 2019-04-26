<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeOldMinOldMaxToDoctorServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_service', function (Blueprint $table) {
            $table->integer('time')->nullable()->default('10');
            $table->integer('old_min')->nullable()->default('0');
            $table->integer('old_max')->nullable()->default('99');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_service', function (Blueprint $table) {
            $table->dropColumn('time');
            $table->dropColumn('old_min');
            $table->dropColumn('old_max');
        });
    }
}
