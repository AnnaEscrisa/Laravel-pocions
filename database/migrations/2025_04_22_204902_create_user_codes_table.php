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
        Schema::create('user_codes', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('code', 50);
            $table->unsignedInteger('expiration');

            $table->primary(['user_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_codes');
    }
};
