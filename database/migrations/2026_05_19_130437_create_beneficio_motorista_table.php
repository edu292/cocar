<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficio_motorista', function (Blueprint $table) {
            $table->id();

            $table->foreignId('beneficio_id')
                ->constrained('beneficios')
                ->cascadeOnDelete();

            $table->foreignId('perfil_motorista_id')
                ->constrained('perfis_motorista')
                ->cascadeOnDelete();


            $table->decimal('km_acumulado', 8, 2)->default(0);


            $table->enum('status', ['em_progresso', 'atingido', 'resgatado'])->default('em_progresso');


            $table->timestamp('atingido_em')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficio_motorista');
    }
};
