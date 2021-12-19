<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpeningBalanceToDelegates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delegates', function (Blueprint $table) {
            $table->double('opening_balance', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delegates', function (Blueprint $table) {
            $table->dropColumn('opening_balance');
        });
    }
}
