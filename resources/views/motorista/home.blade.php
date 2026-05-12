<x-home-layout mode="motorista">
    <x-slot:title>Home Motorista</x-slot:title>
    <x-slot:content>
        <section class="card card--home">
            <form class="route-builder">
                <div class="field">
                    <div class="field__input-wrapper route-builder__input-wrapper">
                        <input type="text" placeholder="Saindo de onde?" required>
                    </div>
                </div>
                <div class="field">
                    <div class="field__input-wrapper route-builder__input-wrapper">
                        <input type="text" placeholder="Indo para onde?" required>
                    </div>
                </div>
                <div class="route-builder__row">
                    <div class="field route-builder__field-time">
                        <div class="field__input-wrapper route-builder__input-wrapper">
                            <input type="time" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn--blue route-builder__btn">Publicar Trajeto</button>
                </div>
                <div class="acoes-motorista">
                    <a href="{{ route('motorista.grupos.criar') }}" class="btn btn--blue route-builder__btn">
                        + Criar Grupo de Carona
                    </a>
                </div>

                @if(session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
                @endif
            </form>
        </section>

        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-blue">Sua Agenda</h3>
            <div class="trip-list">

                <!-- MODIFICADO: Substituídos os trip-cards estáticos pelo loop foreach dinâmico dos $grupos -->
                @forelse($grupos as $grupo)
                <div class="trip-card">
                    <div class="trip-card__header">
                        <span class="trip-card__time text-orange">{{ ucfirst($grupo->frequencia) }}</span>
                        <span class="badge badge--blue">{{ $grupo->passageiros_count }} / {{ $grupo->vagas }} Vagas</span>
                    </div>
                    <div class="trip-card__path">
                        <span class="trip-card__location" style="font-weight:bold;">{{ $grupo->nome }}</span>
                    </div>
                    <div class="trip-card__actions">
                        <button class="btn btn--outline trip-card__btn-msg" aria-label="Mensagear passageiros">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m-2 12H6v-2h12zm0-3H6V9h12zm0-3H6V6h12z" />
                            </svg>
                        </button>
                        <button class="btn btn--green trip-card__btn-confirm">
                            Ver Detalhes
                        </button>
                    </div>
                </div>
                @empty
                <div class="empty-state-wrapper empty-state-wrapper--compact">
                    <div class="card card--empty">
                        <p>Nenhum grupo de carona criado.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </section>
    </x-slot:content>
</x-home-layout>
