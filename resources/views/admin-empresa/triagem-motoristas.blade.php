<x-dashboard-layout>
    <x-slot:title>Aprovar Motoristas</x-slot:title>
    <x-slot:content>
        <div class="cards-grid">
            @forelse($pendingDrivers as $driver)
                <div class="card card--stretch">
                    <div class="card__header card__header--left">
                        <h2 class="card__heading card__heading--small text-blue">{{ $driver->user->name }}</h2>
                    </div>

                    <div class="data-list">
                        <div class="data-list__item">
                            <span class="data-list__label">Email</span>
                            <span class="data-list__value">{{ $driver->user->email }}</span>
                        </div>
                        <div class="data-list__item">
                            <span class="data-list__label">CPF</span>
                            <span class="data-list__value">{{ $driver->user->cpf }}</span>
                        </div>
                        <div class="data-list__item">
                            <span class="data-list__label">CNH</span>
                            <span class="data-list__value">{{ $driver->cnh }}</span>
                        </div>
                    </div>

                    <div class="card__actions">
                        <form action="/drivers/{{ $driver->id }}/reject" method="POST" class="action-form">
                            @csrf
                            <button type="submit" class="btn btn--outline btn--red">Rejeitar</button>
                        </form>
                        <form action="/drivers/{{ $driver->id }}/approve" method="POST" class="action-form">
                            @csrf
                            <button type="submit" class="btn btn--green">Aprovar</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="card">
                    <p class="card__text">Nenhuma aprovação pendente no momento.</p>
                </div>
            @endforelse
        </div>
    </x-slot:content>
</x-dashboard-layout>
