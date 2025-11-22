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
    Schema::create('skill_offers', function (Blueprint $table) {
        $table->id();
        $table->string('name');                 // Name of the person offering the skill
        $table->string('skill_name');           // Name of the skill (e.g. Python, Cooking)
        $table->string('skill_level');          // Beginner / Intermediate / Advanced
        $table->string('session_type');         // Online / In-person
        $table->string('contact_method');       // Email / Phone
        $table->text('availability_notes')->nullable();  // Optional field
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_offers');
    }
};
