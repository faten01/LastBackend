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
        Schema::create('stands', function (Blueprint $table) {
            $table->id('id_stand');
            $table->unsignedBigInteger('exposant_id'); // Foreign key to the users table
            $table->double('superficie');
            $table->double('longeur');
            $table->double('largeur');
            $table->string('numero');
            $table->enum('etat', ['disponible', 'reservee', 'non disponible']);
            $table->timestamps();
            $table->foreign('exposant_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stands');
    }
};
