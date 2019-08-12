<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTeamsTableWithAwards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->boolean('won_first_place')->after('name')->default(false);
            $table->boolean('won_motivation_award')->after('won_first_place')->default(false);
            $table->boolean('won_theme_award')->after('won_motivation_award')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('won_first_place');
            $table->dropColumn('won_motivation_award');
            $table->dropColumn('won_theme_award');
        });
    }
}
