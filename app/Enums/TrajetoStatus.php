<?php

namespace App\Enums;

enum TrajetoStatus: string
{
    case PLANEJADO = 'planejado';
    case EM_ANDAMENTO = 'em_andamento';
    case CONCLUIDO = 'concluido';
    case CANCELADO = 'cancelado';
}
