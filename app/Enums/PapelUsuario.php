<?php

namespace App\Enums;

enum PapelUsuario: string
{
    case AdministradorEmpresa = 'administrador_empresa';
    case AdministradorSistema = 'administrador_sistema';
    case Motorista = 'motorista';
    case Passageiro = 'passageiro';

    public function label(): string
    {
        return match ($this) {
            self::AdministradorEmpresa => 'Administrador da empresa',
            self::AdministradorSistema => 'Administrador do sistema',
            self::Motorista => 'Motorista',
            self::Passageiro => 'Passageiro',
        };
    }
}
