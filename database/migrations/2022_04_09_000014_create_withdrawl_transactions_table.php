<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawl_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('recieved_amount')->nullable();
            $table->string('commision')->nullable();
            $table->string('status')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('host_profile_id');

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
        Schema::dropIfExists('withdrawl_transactions');
    }
};
