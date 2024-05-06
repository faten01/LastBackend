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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->boolean('acceptation')->default(false); // Boolean field for acceptation
            $table->unsignedBigInteger('stand_id'); // Foreign key to stands table
            $table->unsignedBigInteger('event_id'); // Foreign key to events table
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamps();
            $table->foreign('stand_id')->references('id_stand')->on('stands')->onDelete('cascade');
          //  $table->foreign('event_id')->references('id_event')->on('evenements')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
