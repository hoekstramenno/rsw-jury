<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingPrintViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_print_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('view');
            $table->string('direction');
            $table->unsignedBigInteger('rating_id');
            $table->foreign('rating_id')->references('id')->on('ratings');
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
        Schema::dropIfExists('rating_print_views');
    }
}
