<?php

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
            $table->unsignedInteger('investor');
            $table->json('product');
            $table->json('price');
            $table->json('quantity');
            $table->double('total');
            $table->string('payment_type')->nullable();
            $table->unsignedInteger('payment')->nullable();
            $table->unsignedInteger('accountant_id');
            $table->json('delivered')->nullable();
            $table->json('deposited')->nullable();
            $table->double('deposited_amount')->nullable();
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
