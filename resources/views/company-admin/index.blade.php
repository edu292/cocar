<x-dashboard-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:content>
        <div class="card card--dashboard">
            <div class="card__header">
                <h1 class="card__heading text-blue">{{ $company->name }}</h1>
                <p class="card__text">CNPJ: {{ $company->cnpj }}</p>
            </div>

            <div class="stats-grid">
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-blue">{{ $totalUsers }}</span>
                    <span class="stats-grid__label">Total de Usuários</span>
                </div>
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-green">{{ $totalDrivers }}</span>
                    <span class="stats-grid__label">Motoristas Ativos</span>
                </div>
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-orange">{{ $totalPendingDrivers }}</span>
                    <span class="stats-grid__label">Aprovações Pendentes</span>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-dashboard-layout>
