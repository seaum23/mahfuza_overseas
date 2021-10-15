<?php

use App\Models\Candidate;
use App\Models\SponsorVisa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * All tingInterger value means the same: 
         * 0 -> Not done
         * 1 -> Done
         */
        Schema::create('processings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Candidate::class);
            $table->foreignIdFor(SponsorVisa::class);
            $table->tinyInteger('employee_request');
            $table->tinyInteger('foreign_mole');
            $table->tinyInteger('okala');
            $table->string('okala_file');
            $table->tinyInteger('mufa');
            $table->string('mufa_file');
            $table->tinyInteger('medical_update');
            $table->tinyInteger('visa_stamping');
            $table->string('visa_stamping_file');
            $table->date('visa_stamping_date');
            $table->tinyInteger('finger');
            $table->tinyInteger('manpower');
            $table->string('manpower_card_file');
            $table->bigInteger('updated_by');
            $table->string('comment');
            
            /**
             * Pending has different values then other tingIntegers:
             * 0 - Assigned
             * 1 - Assigned ticket date has passed - pending
             * 2 - 3 months after ticket date - completed
             * 3 - 3 months before ticket date if return - returned
             */
            $table->tinyInteger('pending');
            $table->date('pending_till');
            $table->string('youtube');
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
        Schema::dropIfExists('processings');
    }
}
