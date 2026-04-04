<?php

namespace App\Enums;

enum TipoUsuario: string
{
    case AdministradorOrganizacao = 'administrador_organizacao';
    case AdministradorSistema = 'administrador_sistema';
    case Padrao = 'padrao';

    public function label(): string
    {
        return match ($this) {
            self::AdministradorOrganizacao => 'Administrador de Organização',
            self::AdministradorSistema => 'Administrador do sistema',
            self::Padrao => 'Padrão',
        };
    }
}
