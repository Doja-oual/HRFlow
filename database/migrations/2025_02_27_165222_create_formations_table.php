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
        Schema::create('formations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
                $table->string('title', 255);
                $table->text('description')->nullable();
                $table->string('institution', 255);
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->enum('status', ['completed', 'ongoing', 'planned'])->default('planned');
                $table->string('certificate')->nullable(); // Stocker le certificat via Laravel Media Library
                $table->timestamps();
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
