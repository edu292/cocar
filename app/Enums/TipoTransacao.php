<?php

namespace App\Enums;

enum TipoTransacao: string
{
    case DEPOSITO = 'deposito';
    case RETENCAO = 'retencao';
    case LIQUIDACAO = 'liquidacao';
    case ESTORNO = 'estorno';
    case REEMBOLSO = 'reembolso';

    public function label(): string
    {
        return match ($this) {
            self::RETENCAO => 'Reserva de Saldo',
            self::LIQUIDACAO => 'Fechamento da Carona',
            self::REEMBOLSO => 'Ajuda de Custo',
            self::DEPOSITO => 'Depósito',
            self::ESTORNO => 'Estorno'
        };
    }

    public function direcao(): DirecaoTransacao
    {
        return match ($this) {
            self::DEPOSITO, self::REEMBOLSO, self::ESTORNO => DirecaoTransacao::ENTRADA,
            self::RETENCAO, self::LIQUIDACAO => DirecaoTransacao::SAIDA,
        };
    }

    public function contexto(): ContextoTransacao
    {
        return match ($this) {
            self::REEMBOLSO => ContextoTransacao::TRAJETO,
            self::RETENCAO, self::LIQUIDACAO, self::ESTORNO => ContextoTransacao::PEDIDO_CARONA,
            self::DEPOSITO => ContextoTransacao::NENHUM
        };
    }
}
