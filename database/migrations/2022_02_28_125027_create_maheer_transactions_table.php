<?php

use App\Models\Candidate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaheerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maheer_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('currency', 15);
            $table->double('debit', 12, 2)->default(0);
            $table->double('credit', 12, 2)->default(0);
            $table->double('exchange_rate', 12, 2);
            $table->nullableMorphs('particular'); // Differnet particular: `agent`, `delegate`, `manpower`, `office`
            $table->foreignIdFor(Candidate::class)->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('transaction_type')->nullable(); // 0 -> take, 1 -> give/spend
            $table->date('input_date')->nullable();
            $table->string('purpose')->nullable();
            $table->string('receipt')->nullable();
            $table->double('adjusted_value', 12, 2)->nullable();
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
        Schema::dropIfExists('maheer_transactions');
    }
}
