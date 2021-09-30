<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_visas', function (Blueprint $table) {
            $table->id();
            $table->string('sponsor_visa')->unique();
            $table->date('issue_date');
            $table->integer('visa_amount');
            $table->string('visa_gender_type', 10);
            $table->foreignId('job_id');
            $table->foreignId('sponsor_id');
            $table->string('comment');
            $table->double('visa_rate');
            $table->integer('updated_by');
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
        Schema::dropIfExists('sponsor_visas');
    }
}
