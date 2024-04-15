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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id("id_event");
            $table->string("nom");
            $table->string("description");
            $table->string("affiche");
            $table->string("ville");
            $table->date('date')->nullable(); 
            $table->unsignedBigInteger('id_rating');
            $table->unsignedBigInteger('id_type'); // Foreign key to events table

             // Foreign key to the users table
            // New date column
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
