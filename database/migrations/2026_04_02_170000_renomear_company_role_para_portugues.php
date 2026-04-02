<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('companies') && ! Schema::hasTable('empresas')) {
            Schema::rename('companies', 'empresas');
        }

        if (Schema::hasTable('empresas') && Schema::hasColumn('empresas', 'email_domain')) {
            Schema::table('empresas', function (Blueprint $table) {
                $table->renameColumn('email_domain', 'dominio_email');
            });
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'company_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('company_id');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('company_id', 'empresa_id');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->foreign('empresa_id')->references('id')->on('empresas')->nullOnDelete();
            });
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('role', 'papel');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'papel')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('papel', 'role');
            });
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'empresa_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['empresa_id']);
            });

            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('empresa_id', 'company_id');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->foreign('company_id')->references('id')->on('companies')->nullOnDelete();
            });
        }

        if (Schema::hasTable('empresas') && Schema::hasColumn('empresas', 'dominio_email')) {
            Schema::table('empresas', function (Blueprint $table) {
                $table->renameColumn('dominio_email', 'email_domain');
            });
        }

        if (Schema::hasTable('empresas') && ! Schema::hasTable('companies')) {
            Schema::rename('empresas', 'companies');
        }
    }
};
