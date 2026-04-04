<x-dashboard-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:content>
        <div class="card card--dashboard">
            <div class="card__header">
                <h1 class="card__heading text-blue">{{ $organizacao->nome }}</h1>
                <p class="card__text">CNPJ: {{ $organizacao->cnpj }}</p>
            </div>

            <div class="stats-grid">
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-blue">{{ $totalUsuarios }}</span>
                    <span class="stats-grid__label">Total de Usuários Cadastrados</span>
                </div>
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-green">{{ $totalMotoristasAtivos }}</span>
                    <span class="stats-grid__label">Motoristas ativos</span>
                </div>
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-orange">{{ $totalMotoristasPendentes }}</span>
                    <span class="stats-grid__label">Aprovações pendentes</span>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-dashboard-layout>
