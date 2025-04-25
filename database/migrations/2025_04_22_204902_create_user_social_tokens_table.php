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
        Schema::create('user_social_tokens', function (Blueprint $table) {
            $table->integer('user_fk');
            $table->string('social_id', 50)->nullable();
            $table->string('token', 200);
            $table->string('social', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_social_tokens');
    }
};
