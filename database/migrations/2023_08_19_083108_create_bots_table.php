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
        Schema::create('bots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('apikey')->unique()->nullable(false);
            $table->string('id_bot')->unique()->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('status')->default('0')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bots');
    }
};
