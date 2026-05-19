<?php

namespace App\Enums;

enum CaronaStatus: string
{
    case AGUARDANDO_INICIO = 'aguardando_inicio';
    case MOTORISTA_A_CAMINHO = 'motorista_a_caminho';

    case EM_ANDAMENTO = 'em_andamento';
    case CONCLUIDA = 'concluida';

    case PASSAGEIRO_NAO_COMPARECEU = 'passageiro_nao_compareceu';
    case CANCELADA_PELO_MOTORISTA = 'cancelada_pelo_motorista';
    case CANCELADA_PELO_PASSAGEIRO = 'cancelada_pelo_passageiro';
}
