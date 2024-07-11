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
        Schema::create('diretoria', function (Blueprint $table) {
            $table->id();
            $table->string('diretoria');
            $table->unsignedBigInteger('diretor_id');
            $table->timestamps();
            $table->foreign('diretor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diretoria');
    }
};
