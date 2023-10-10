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
        Schema::create('users_telegram', function (Blueprint $table) {
            $table->id();
            $table->string("chat_id",50)->unique();
            $table->string('first_name', 250);
            $table->string('last_name', 250)->nullable();
            $table->string('username',250)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
