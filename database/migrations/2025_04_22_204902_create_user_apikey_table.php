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
        Schema::create('user_apikey', function (Blueprint $table) {
            $table->integer('user_fk');
            $table->string('apikey', 200);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expiracio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_apikey');
    }
};
