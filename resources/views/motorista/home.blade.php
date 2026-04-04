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
            </form>
        </section>

        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-blue">Sua Agenda</h3>
            <div class="trip-list">

                <div class="trip-card">
                    <div class="trip-card__header">
                        <span class="trip-card__time text-orange">Hoje, 18:00</span>
                        <span class="badge badge--blue">3/4 Vagas</span>
                    </div>
                    <div class="trip-card__path">
                        <span class="trip-card__location">Sede Corporativa</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
                        </svg>
                        <span class="trip-card__location">Terminal Central</span>
                    </div>
                    <div class="trip-card__actions">
                        <button class="btn btn--outline trip-card__btn-msg" aria-label="Mensagear passageiros">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m-2 12H6v-2h12zm0-3H6V9h12zm0-3H6V6h12z" />
                            </svg>
                        </button>
                        <button class="btn btn--green trip-card__btn-confirm">
                            Confirmar Partida
                        </button>
                    </div>
                </div>

                <div class="trip-card">
                    <div class="trip-card__header">
                        <span class="trip-card__time text-text-muted">Amanhã, 07:30</span>
                        <span class="badge badge--gray">0/4 Vagas</span>
                    </div>
                    <div class="trip-card__path">
                        <span class="trip-card__location">Terminal Central</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
                        </svg>
                        <span class="trip-card__location">Sede Corporativa</span>
                    </div>
                    <div class="trip-card__actions">
                        <button class="btn btn--outline trip-card__btn-msg" disabled aria-label="Mensagear passageiros">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m-2 12H6v-2h12zm0-3H6V9h12zm0-3H6V6h12z" />
                            </svg>
                        </button>
                        <button class="btn btn--outline trip-card__btn-confirm text-blue">
                            Editar Trajeto
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </x-slot:content>
</x-home-layout>
