<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ip')->unique();
            $table->string('modelo')->nullable();
            $table->string('ssid')->nullable();
            $table->string('direcao')->nullable();
            $table->string('frequencia')->nullable();
            $table->string('canal')->nullable();
            $table->string('senhawifi')->nullable();
            $table->string('login')->nullable();
            $table->string('senhaacesso')->nullable();
            $table->unsignedBigInteger('ptp_id')->nullable();

            // Campo status para monitoramento (online/offline/desconhecido)
          

            $table->timestamps();

            // Se quiser manter integridade referencial:
            $table->foreign('ptp_id')->references('id')->on('ptps')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('radios');
    }
};
