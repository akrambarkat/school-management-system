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
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('National_ID');
            $table->date('Date_Birth');
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete();
            $table->foreignId('Religion_id')->constrained('religions')->cascadeOnDelete();
            $table->foreignId('Nationality_id')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('parent_id')->constrained('my_parents')->cascadeOnDelete();
            $table->string('academic_year');
            $table->softDeletes('deleted_at');
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
