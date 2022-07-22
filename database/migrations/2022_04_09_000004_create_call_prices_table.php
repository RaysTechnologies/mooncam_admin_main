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
        Schema::create('call_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('video_call')->nullable();
            $table->string('live_streaming')->nullable();
            $table->string('video_call_price_limit')->nullable();
            $table->string('live_streaming_call_price_limit')->nullable();
            $table->string('photo_price')->nullable();
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
        Schema::dropIfExists('call_prices');
    }
};
