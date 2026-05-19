<?php

use App\Enums\CaronaStatus;
use App\Models\PedidoCarona;
use App\Models\Trajeto;
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
        Schema::create('caronas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PedidoCarona::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Trajeto::class)->constrained()->cascadeOnDelete();
            $table->integer('ordem')->nullable();
            $table->string('status')->default(CaronaStatus::AGUARDANDO_INICIO);
            $table->timestamps();
            $table->unique(['pedido_carona_id', 'trajeto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caronas');
    }
};
