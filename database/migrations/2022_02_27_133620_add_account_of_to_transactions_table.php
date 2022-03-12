<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountOfToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->tinyInteger('account_of')->default(0); // 0 -> Mahfuza Account; 1 -> Maheer Account
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('account_of');
        });
    }
}
