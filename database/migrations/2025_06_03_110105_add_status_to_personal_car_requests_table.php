<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('personal_car_requests', function (Blueprint $table) {
            $table->string('status')->default('pending'); // pending, approved, rejected
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_car_requests', function (Blueprint $table) {
            //
        });
    }
};
