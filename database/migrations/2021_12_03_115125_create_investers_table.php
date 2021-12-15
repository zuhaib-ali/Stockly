<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cnic')->unique();
            $table->string('address');
            $table->string('password');
            $table->string('nominee_name')->nullable();
            $table->string('nominee_cnic')->nullable();
            $table->string('nominee_relationship')->nullable();
            $table->string('image')->nullable();
            $table->string('cnic_front');
            $table->string('cnic_back');
            $table->string('referral_code')->unique()->nullable();
            $table->boolean('terms_conditions');
            $table->boolean('accountant_id');
            $table->unsignedInteger('level')->nullable();
            $table->string('level_name')->nullable();
            $table->double('points')->nullable();
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
        Schema::dropIfExists('investers');
    }
}
