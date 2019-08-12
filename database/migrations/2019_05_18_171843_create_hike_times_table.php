<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikeTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hike_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')
                  ->references('id')
                  ->on('years')
                  ->onDelete('cascade');
            $table->unsignedInteger('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hike_times', function (Blueprint $table) {
            $table->dropForeign('team_id');
        });
        Schema::table('hike_times', function (Blueprint $table) {
            $table->dropForeign('year_id');
        });
        Schema::dropIfExists('hike_times');
    }
}
