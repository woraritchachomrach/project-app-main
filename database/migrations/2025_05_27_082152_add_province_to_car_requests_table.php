<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('car_requests', function (Blueprint $table) {
            $table->string('province')->nullable(); // เพิ่มคอลัมน์จังหวัด
        });
    }

    public function down(): void
    {
        Schema::table('car_requests', function (Blueprint $table) {
            $table->dropColumn('province');
        });
    }
};
