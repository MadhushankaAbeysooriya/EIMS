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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission',100)->unique();
            $table->string('name_initials',150);
            $table->string('full_name',255)->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender');//female->0, male->1
            $table->date('enlist_date')->nullable();
            $table->string('address',500)->nullable();
            $table->tinyInteger('status')->default(1);//active->1, in-active->0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
