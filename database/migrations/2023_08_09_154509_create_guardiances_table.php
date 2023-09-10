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
        Schema::create('guardiances', function (Blueprint $table) {
            $table->id();
            $table->string('nic')->unique();
            $table->string('sec_contact',12)->unique();
            $table->unsignedBigInteger('guardiance_type_id')->nullable();
            $table->foreign('guardiance_type_id')->references('id')->on('guardiance_types')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardiances');
    }
};
