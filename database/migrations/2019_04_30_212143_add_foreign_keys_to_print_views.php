<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPrintViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rating_print_views', function (Blueprint $table) {
            $table->foreign('rating_id')
                  ->references('id')
                  ->on('ratings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rating_print_views', function (Blueprint $table) {
            $table->dropForeign('rating_id');
        });
    }
}
