<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('passageiros', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
        $table->char('cpf', 11)->unique();
        $table->decimal('nota_media', 3, 2)->default(5.00);
        $table->timestamps();
        /** $table->foreignId('id_empresa')->constrained('empresas')->onDelete('cascade'); **/
    });
    }   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passageiros');
    }
};
