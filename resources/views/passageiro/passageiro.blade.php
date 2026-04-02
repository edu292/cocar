<x-layout>
    <x-slot:title>Painel do passageiro - CoCar</x-slot:title>

    <x-slot:content>
        <div class="passageiro-page bg-grafismo">
            <div class="passageiro-shell">
                <section class="passageiro-hero">
                    <div class="brand-stripe brand-stripe--top"></div>
                    <p class="passageiro-hero__eyebrow">Área do passageiro</p>
                    <h1 class="passageiro-hero__title">Olá, {{ auth()->user()->name }}!</h1>
                    <p class="passageiro-hero__text">
                        Bem-vindo ao seu painel. Gerencie seus dados antes de pedir ou acompanhar caronas.
                    </p>
                </section>

                <section class="passageiro-grid" aria-label="Atalhos do passageiro">
                    <a href="{{ route('passageiro.perfil') }}" class="passageiro-card">
                        <div class="passageiro-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="passageiro-card__content">
                            <h2 class="passageiro-card__title">Meu perfil</h2>
                            <p class="passageiro-card__text">
                                Atualize nome e CPF para manter sua conta pronta para uso.
                            </p>
                        </div>
                    </a>
                </section>
            </div>
        </div>
    </x-slot:content>
</x-layout>
