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
            if (! Schema::hasColumn('users', 'empresa_id') && Schema::hasTable('empresas')) {
                $table->foreignId('empresa_id')->nullable()->constrained('empresas')->nullOnDelete();
            }

            if (! Schema::hasColumn('users', 'papel') && ! Schema::hasColumn('users', 'role')) {
                $table->string('papel')->nullable();
            }

            if (! Schema::hasColumn('users', 'status')) {
                $table->string('status')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'empresa_id')) {
                $table->dropConstrainedForeignId('empresa_id');
            }

            $colunas = [];

            if (Schema::hasColumn('users', 'papel')) {
                $colunas[] = 'papel';
            }

            if (Schema::hasColumn('users', 'status')) {
                $colunas[] = 'status';
            }

            if ($colunas !== []) {
                $table->dropColumn($colunas);
            }
        });
    }
};
