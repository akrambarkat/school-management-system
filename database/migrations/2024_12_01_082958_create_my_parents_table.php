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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();


            //Fatherinformation
            $table->string('Name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('Address');
            $table->string('National_ID');
            $table->string('Phone');
            $table->string('Job')->nullable();
            $table->foreignId('Nationality_id')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('Religion_id')->constrained('religions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
