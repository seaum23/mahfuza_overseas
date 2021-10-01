<?php

use App\Models\Job;
use App\Models\ManpowerOffice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManpowerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpower_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manpower_id');
            $table->foreignId('job_id');
            $table->integer('processing_cost');
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
        Schema::dropIfExists('manpower_jobs');
    }
}
