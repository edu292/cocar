<?php

namespace App\Enums;

enum TipoTransacao: string
{
    case PAGAMENTO = 'pagamento';
    case RECEBIMENTO = 'recebimento';
}
