<?php

namespace App\Enums;

enum StatusTrajeto: string
{
    case PLANEJADO = 'planejado';
    case EM_ANDAMENTO = 'em_andamento';
    case CONCLUIDO = 'concluido';
    case CANCELADO = 'cancelado';
}
