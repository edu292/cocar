<?php

use App\Enums\TrajetoStatus;
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
        Schema::create('trajetos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motorista')->constrained('users')->cascadeOnDelete();
            $table->geography('localizacao_motorista', subtype: 'point')->nullable();
            $table->geography('origem', subtype: 'point')->index();
            $table->geography('destino', subtype: 'point')->index();
            $table->geography('rota', subtype: 'lineString')->index();
            $table->double('distancia_percorrida')->default(0);
            $table->decimal('custo')->default(0);
            $table->string('status')->default(TrajetoStatus::PLANEJADO);
            $table->timestampTz('horario_inicio')->nullable();
            $table->timestampTz('horario_fim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajetos');
    }
};
