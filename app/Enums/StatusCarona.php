<?php

namespace App\Enums;

enum StatusCarona: string
{
    case PROCURANDO_MOTORISTA = 'procurando_motorista';

    case AGUARDANDO_EMBARQUE = 'aguardando_embarque';
    case EM_ANDAMENTO = 'em_andamento';

    case CONCLUIDA = 'concluida';

    case PASSAGEIRO_AUSENTE = 'passageiro_ausente';
    case CANCELADA_MOTORISTA = 'cancelada_motorista';
    case CANCELADA_PASSAGEIRO = 'cancelada_passageiro';

    public function label(): string
    {
        return match ($this) {
            self::PROCURANDO_MOTORISTA => 'Procurando Motorista',
            self::AGUARDANDO_EMBARQUE => 'Aguardando Embarque',
            self::EM_ANDAMENTO => 'Em Andamento',
            self::CONCLUIDA => 'Concluída',
            self::PASSAGEIRO_AUSENTE => 'Passageiro Ausente',
            self::CANCELADA_MOTORISTA => 'Cancelado pelo Motorista',
            self::CANCELADA_PASSAGEIRO => 'Cancelado pelo passageiro'
        };
    }

    public function fase(): FaseCarona
    {
        return match ($this) {
            self::PROCURANDO_MOTORISTA => FaseCarona::DESCOBERTA,
            self::AGUARDANDO_EMBARQUE, self::EM_ANDAMENTO => FaseCarona::ATIVA,
            self::CONCLUIDA => FaseCarona::SUCESSO,
            self::PASSAGEIRO_AUSENTE, self::CANCELADA_MOTORISTA, self::CANCELADA_PASSAGEIRO => FaseCarona::FALHA
        };
    }

    public static function naFase(FaseCarona $fase): array
    {
        return array_filter(
            self::cases(),
            fn ($status) => $status->fase() === $fase
        );
    }
}
