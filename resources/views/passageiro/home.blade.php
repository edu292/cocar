<x-home-layout mode="passageiro">
    <x-slot:title>Passageiro</x-slot:title>
    <x-slot:content>
        <section class="card card--home">
            <form class="search-bar">
                <div class="field search-bar__field">
                    <div class="field__input-wrapper search-bar__input-wrapper">
                        <div class="field__input-icon text-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Para onde deseja ir?" required>
                    </div>
                </div>
                <button type="submit" class="btn btn--blue search-bar__btn" aria-label="Buscar destino">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.05-.35 2.025T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                </button>
                </button>
            </form>
            
            <!-- MODIFICADO: Adicionado feedback de sessão (erros e sucessos) -->
            @if(session('sucesso'))
                <div class="alert alert-success" style="margin-top:15px; color:green;">
                    {{ session('sucesso') }}
                </div>
            @endif
            @if(session('erro'))
                <div class="alert alert-danger" style="margin-top:15px; color:red;">
                    {{ session('erro') }}
                </div>
            @endif

            <div class="shortcuts">
                <button class="shortcuts__item">
                    <div class="shortcuts__icon text-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                        </svg>
                    </div>
                    <span class="shortcuts__label">Casa</span>
                </button>
                <button class="shortcuts__item">
                    <div class="shortcuts__icon text-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z" />
                        </svg>
                    </div>
                    <span class="shortcuts__label">Trabalho</span>
                </button>
                <button class="shortcuts__item">
                    <div class="shortcuts__icon text-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05c1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <span class="shortcuts__label">Escritório RH</span>
                </button>
                <button class="shortcuts__item">
                    <div class="shortcuts__icon text-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                        </svg>
                    </div>
                    <span class="shortcuts__label">Adicionar</span>
                </button>
                <a href="{{ route('usuario.carteira') }}" class="shortcuts__item shortcuts__item--rigth">
                    <div class="shortcuts__icon text-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M95.5 104h320a88 88 0 0 1 11.18.71a66 66 0 0 0-77.51-55.56L86 94.08h-.3a66 66 0 0 0-41.07 26.13A87.57 87.57 0 0 1 95.5 104m320 24h-320a64.07 64.07 0 0 0-64 64v192a64.07 64.07 0 0 0 64 64h320a64.07 64.07 0 0 0 64-64V192a64.07 64.07 0 0 0-64-64M368 320a32 32 0 1 1 32-32a32 32 0 0 1-32 32" />
                            <path fill="currentColor"
                                d="M32 259.5V160c0-21.67 12-58 53.65-65.87C121 87.5 156 87.5 156 87.5s23 16 4 16s-18.5 24.5 0 24.5s0 23.5 0 23.5L85.5 236Z" />
                        </svg>
                    </div>
                    <span class="shortcuts__label">Carteira</span>
                </a>

            </div>
        </section>

        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-blue">Próximas Caronas</h3>
            <p class="card__text card__text--left card__text--secondary">Sua agenda de mobilidade coletiva.</p>
            
            <!-- MODIFICADO: Mostrando grupos que o passageiro participa -->
            <div class="trip-list" style="margin-top: 15px;">
                @forelse($meusGrupos as $grupo)
                <div class="trip-card">
                    <div class="trip-card__header">
                        <span class="trip-card__time text-blue">{{ ucfirst($grupo->frequencia) }}</span>
                        <span class="badge badge--green">Inscrito</span>
                    </div>
                    <div class="trip-card__path">
                        <span class="trip-card__location" style="font-weight:bold;">{{ $grupo->nome }}</span>
                    </div>
                    <div class="trip-card__actions" style="margin-top:10px;">
                        <span style="font-size:14px; color:#6b7280;">Motorista: {{ $grupo->motorista->user->name }}</span>
                    </div>
                </div>
                @empty
                <div class="empty-state-wrapper empty-state-wrapper--compact">
                    <div class="card card--empty">
                        <div class="card__icon text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5s-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                            </svg>
                        </div>
                        <p>Nenhuma rota programada. Inscreva-se numa carona abaixo!</p>
                    </div>
                </div>
                @endforelse
            </div>
        </section>
        
        <!-- MODIFICADO: Nova section para caronas disponíveis para aplicar -->
        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-orange">Caronas Disponíveis</h3>
            <p class="card__text card__text--left card__text--secondary">Junte-se a grupos da sua organização.</p>
            <div class="trip-list" style="margin-top: 15px;">
                @forelse($gruposDisponiveis as $grupo)
                <div class="trip-card">
                    <div class="trip-card__header">
                        <span class="trip-card__time text-text-muted">{{ ucfirst($grupo->frequencia) }}</span>
                        <span class="badge badge--blue">{{ $grupo->vagas - $grupo->passageiros_count }} Vagas Livres</span>
                    </div>
                    <div class="trip-card__path">
                        <span class="trip-card__location" style="font-weight:bold;">{{ $grupo->nome }}</span>
                    </div>
                    <div class="trip-card__actions" style="margin-top:10px; display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:14px; color:#6b7280;">{{ $grupo->motorista->user->name }}</span>
                        
                        <form action="{{ route('grupos.entrar', $grupo->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn--green" style="padding: 6px 12px; font-size:14px;">
                                Participar
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state-wrapper empty-state-wrapper--compact">
                    <div class="card card--empty">
                        <p>Nenhuma carona com vagas disponível no momento.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </section>

        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-green">Nosso Impacto</h3>
            <div class="stats-grid stats-grid--compact">
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-green">34kg</span>
                    <span class="stats-grid__label">CO₂ Poupado</span>
                </div>
                <div class="stats-grid__item">
                    <span class="stats-grid__value text-orange">12</span>
                    <span class="stats-grid__label">Conexões Feitas</span>
                </div>
            </div>
        </section>
    </x-slot:content>
</x-home-layout>
