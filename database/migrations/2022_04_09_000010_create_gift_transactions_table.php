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
        Schema::create('gift_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reciever_id')->nullable();
            $table->string('sender_id');
            $table->string('gift_id')->nullable();
            $table->string('gift_name')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('gift_transactions');
    }
};
