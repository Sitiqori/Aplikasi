<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ulasan_buku', function (Blueprint $table) {
            $table->unsignedBigInteger('rent_log_id');
            $table->foreign('rent_log_id')->references('id')->on('rent_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ulasan_buku', function (Blueprint $table) {
            $table->dropForeign(['rent_log_id']);
            $table->dropColumn('rent_log_id');
        });
    }
};
