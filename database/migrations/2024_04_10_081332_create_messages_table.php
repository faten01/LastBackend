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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id_message');
            $table->string('contenu'); 
            $table->date('dateEnvoi')->nullable(); 
            $table->date('dateRecu')->nullable(); 
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_exposant');
            $table->timestamps();
            //$table->foreign('exposant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_chat')->references('id_chat')->on('chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
