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
            $table->dateTime('flight_time');
            $table->double('transit', 3, 1);
            $table->double('ticket_price', 10, 2);
            $table->string('flight_number', 100);
            $table->string('flight_from', 100);
            $table->string('flight_to', 100);
            $table->string('airline', 100);
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
