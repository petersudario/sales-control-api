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
        Schema::create('unidade', function (Blueprint $table) {
            $table->id();
            $table->string('unidade');
            $table->float('latitude');
            $table->float('longitude');
            $table->unsignedBigInteger('gerente_id');
            $table->unsignedBigInteger('diretoria_id');
            $table->timestamps();
            $table->foreign('gerente_id')->references('id')->on('users');
            $table->foreign('diretoria_id')->references('id')->on('diretoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidade');
        
    }
};
