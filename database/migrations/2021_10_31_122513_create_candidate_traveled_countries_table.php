<?php

use App\Models\Candidate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateTraveledCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_traveled_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Candidate::class);
            $table->string('country');
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
        Schema::dropIfExists('candidate_traveled_countries');
    }
}
