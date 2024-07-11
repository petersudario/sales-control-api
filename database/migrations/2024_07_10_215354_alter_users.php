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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cargo')->nullable()->after('email');
            $table->unsignedBigInteger('unidade_id')->nullable()->after('cargo');
            $table->unsignedBigInteger('diretoria_id')->nullable()->after('unidade_id');
            $table->unsignedBigInteger('gerente_id')->nullable()->after('diretoria_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
            $table->foreign('diretoria_id')->references('id')->on('diretoria');
            $table->foreign('gerente_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['unidade_id']);
            $table->dropForeign(['diretoria_id']);
            $table->dropColumn('cargo');
            $table->dropColumn('unidade_id');
            $table->dropColumn('diretoria_id');
        });
    }
};
