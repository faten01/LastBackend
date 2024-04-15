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
      
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('nom')->default('');
                $table->string('email')->unique()->default('');
                $table->string('role')->default('exposant');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('MotDePasse')->default('');
                $table->string('prenom')->default('');
                $table->string('photo')->default('');
                $table->string('ville')->default('');
                $table->string('entreprise')->default('');
                $table->string('telephone')->default('');
    
                $table->rememberToken();
                $table->timestamps();
            });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
