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
        Schema::create('report_and_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blocked_user_id');
            $table->string('blocked_user_name');
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
        Schema::dropIfExists('report_and_blocks');
    }
};
