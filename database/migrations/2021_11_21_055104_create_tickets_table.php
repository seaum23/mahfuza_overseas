<?php

use App\Models\Processing;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('flight_time')->nullable()->nullable();
            $table->double('transit', 3, 1)->nullable();
            $table->double('ticket_price', 10, 2);
            $table->string('flight_number', 100)->nullable();
            $table->string('flight_from', 100)->nullable();
            $table->string('flight_to', 100)->nullable();
            $table->string('airline', 100)->nullable();
            $table->foreignIdFor(Processing::class);
            $table->string('ticket_file')->nullable();
            $table->string('comment')->nullable();
            $table->bigInteger('updated_by');
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
        Schema::dropIfExists('tickets');
    }
}
