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
        Schema::table('free_token_transactions', function (Blueprint $table) {
            $table
                ->foreign('host_profile_id')
                ->references('id')
                ->on('host_profiles')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('free_token_transactions', function (Blueprint $table) {
            $table->dropForeign(['host_profile_id']);
        });
    }
};