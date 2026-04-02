<?php

namespace App\Enums;

enum StatusUsuario: string
{
    case PendenteAprovacao = 'pendente_aprovacao';
    case Ativo = 'ativo';

    public function label(): string
    {
        return match ($this) {
            self::PendenteAprovacao => 'Pendente de aprovação',
            self::Ativo => 'Ativo',
        };
    }
}
