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
            $table->foreignIdFor(Job::class)->nullable();
            $table->string('country', 100)->nullable();
            $table->foreignIdFor(Agent::class);
            $table->foreignIdFor(ManpowerOffice::class)->nullable();
            $table->tinyInteger('test_medical_status')->default(0); // Fit -> 2 || Unfit -> 3 || Not done yet -> 0 || Document Uploaded but fittness pending -> 1
            $table->tinyInteger('final_medical_status')->default(0); // Fit -> 2 || Unfit -> 3 || Not done yet -> 0 || Document Uploaded but fittness pending -> 1
            $table->date('final_medical_report')->nullable()->default(NULL);
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
            $table->string('police_clearance_file')->nullable();
            $table->string('training_card_file')->nullable();
            $table->string('passport_photo_file')->nullable();
            $table->string('passport_scanned_copy')->nullable();
            $table->string('test_medical_file')->nullable();
            $table->string('final_medical_file')->nullable();

            /**
             * For experienced candidate.
             */
            $table->string('departureSealFile')->nullable()->nullable();
            $table->string('arrivalSealFile')->nullable()->nullable();
            $table->date('departure_date')->nullable()->default(NULL);
            $table->date('arrival_date')->nullable()->default(NULL);

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
