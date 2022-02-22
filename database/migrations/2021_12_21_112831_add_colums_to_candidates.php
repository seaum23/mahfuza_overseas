<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToCandidates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('passport_place')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('upzilla')->nullable();
            $table->string('union')->nullable();
            $table->string('house')->nullable();
            $table->string('road')->nullable();
            $table->string('post_office')->nullable();
            $table->string('post_code')->nullable();
            $table->string('profession')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('spouse_name');
            $table->dropColumn('nationality');
            $table->dropColumn('birth_place');
            $table->dropColumn('passport_place');
            $table->dropColumn('division');
            $table->dropColumn('district');
            $table->dropColumn('upzilla');
            $table->dropColumn('union');
            $table->dropColumn('house');
            $table->dropColumn('road');
            $table->dropColumn('post_office');
            $table->dropColumn('post_code');
            $table->dropColumn('profession');
        });
    }
}
