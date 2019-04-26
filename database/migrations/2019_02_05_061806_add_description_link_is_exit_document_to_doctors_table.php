<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionLinkIsExitDocumentToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->longText('description')->nullable();
            $table->longText('link')->nullable();
            $table->string('is_exit')->nullable();
            $table->string('document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('link');
            $table->dropColumn('is_exit');
            $table->dropColumn('document');
        });
    }
}
