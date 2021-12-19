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
            $table->tinyInteger('employee_request')->default(0);
            $table->tinyInteger('foreign_mole')->default(0);
            $table->tinyInteger('okala')->default(0);
            $table->string('okala_file')->nullable();
            $table->tinyInteger('mufa')->default(0);
            $table->string('mufa_file')->nullable();
            $table->tinyInteger('medical_update')->default(0);
            $table->tinyInteger('visa_stamping')->default(0);
            $table->date('visa_stamping_date')->nullable();
            $table->tinyInteger('finger')->default(0);
            $table->tinyInteger('manpower')->default(0);
            $table->string('manpower_card_file')->nullable();
            $table->bigInteger('updated_by');
            $table->string('comment')->nullable();
            
            /**
             * Pending has different values then other tingIntegers:
             * 0 - VISA Assigned
             * 1 - Assigned ticket date has passed - pending
             * 2 - 3 months after ticket date - completed
             * 3 - 3 months before ticket date if return - returned
             */
            $table->tinyInteger('pending')->default(0);
            $table->date('pending_till')->nullable();
            $table->string('youtube')->nullable();
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
