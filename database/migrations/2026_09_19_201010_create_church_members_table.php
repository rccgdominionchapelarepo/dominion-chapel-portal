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
       Schema::create('church_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_family_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('preferred_name')->nullable();
            $table->date('dob')->nullable(); // Optional as requested
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('church_group'); // Excellent Men, Good Women, etc.
            $table->string('membership_status')->nullable();
            $table->string('water_baptism')->nullable();
            $table->json('areas_to_serve')->nullable(); // Stores multiple checkboxes
            $table->string('special_skills')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('church_members');
    }
};
