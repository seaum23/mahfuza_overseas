<?php

use App\Models\Agent;
use App\Models\Job;
use App\Models\ManpowerOffice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('passportNum')->unique()->index();
            $table->integer('delegate_comission')->default(0);
            $table->tinyInteger('delegate_comission_paid')->default(0); // Not paid -> 0 || Paid -> 0
            $table->string('fName');
            $table->string('lName');
            $table->string('phone');
            $table->date('data_of_birth');
            $table->string('gender', 10);
            $table->date('issue_date');
            $table->integer('validity');
            $table->foreignIdFor(Job::class);
            $table->string('country', 100);
            $table->foreignIdFor(Agent::class);
            $table->foreignIdFor(ManpowerOffice::class);
            $table->tinyInteger('test_medical_status')->default(0); // Fit -> 1 || Unfit -> 2 || Not done yet -> 0
            $table->tinyInteger('final_medical_status')->default(0); // Fit -> 1 || Unfit -> 2 || Not done yet -> 0
            $table->date('final_medical_report')->default(NULL);
            $table->tinyInteger('experience_status'); // New -> 1 || Experienced -> 2
            $table->string('comment');
            $table->string('updated_by');
            /**
             * 0 - active
             * 1 - On Hold
             * 2 - Disable
             */
            $table->tinyInteger('status')->default(0);
            $table->string('disable_reason')->default('');

            /**
             * Files.
             */
            $table->string('personal_photo_file')->default('');
            $table->string('police_clearance_file')->default('');
            $table->string('training_card_file')->default('');
            $table->string('passport_photo_file')->default('');
            $table->string('passport_scanned_copy')->default('');
            $table->string('test_medical_file')->default('');
            $table->string('final_medical_file')->default('');

            /**
             * For experienced candidate.
             */
            $table->string('departureSealFile')->default('');
            $table->string('arrivalSealFile')->default('');
            $table->date('departure_date')->default(NULL);
            $table->date('arrival_date')->default(NULL);

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
        Schema::dropIfExists('candidates');
    }
}
