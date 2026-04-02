<?php

namespace App\Enums;

enum TipoUsuario: string
{
    case AdministradorEmpresa = 'administrador_empresa';
    case AdministradorSistema = 'administrador_sistema';
    case Funcionario = 'funcionario';

    public function label(): string
    {
        return match ($this) {
            self::AdministradorEmpresa => 'Administrador da empresa',
            self::AdministradorSistema => 'Administrador do sistema',
            self::Funcionario => 'Funcionário',
        };
    }
}
