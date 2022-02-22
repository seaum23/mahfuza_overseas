<?php

use App\Models\Candidate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique()->index()->nullable(); // Only to show and search records
            $table->integer('quantity');
            $table->string('currency', 15);
            $table->double('unit_price', 12, 2);
            $table->double('exchange_rate', 12, 2);
            $table->nullableMorphs('particular'); // Differnet particular: `agent`, `delegate`, `manpower`, `office`
            $table->foreignIdFor(Candidate::class)->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
