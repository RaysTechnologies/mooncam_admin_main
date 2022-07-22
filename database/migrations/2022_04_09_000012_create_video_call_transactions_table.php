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
        Schema::create('video_call_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reciever_id')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('call_duration')->nullable();
            $table->string('token_charge')->nullable();
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
        Schema::dropIfExists('video_call_transactions');
    }
};
