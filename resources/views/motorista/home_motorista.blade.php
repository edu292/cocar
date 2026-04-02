<x-layout>
    <x-slot:title>Painel do motorista - CoCar</x-slot:title>

    <x-slot:content>
        <div class="passageiro-page bg-grafismo">
            <div class="passageiro-shell">
                <section class="passageiro-hero">
                    <div class="brand-stripe brand-stripe--top"></div>
                    <p class="passageiro-hero__eyebrow">Área do motorista</p>
                    <h1 class="passageiro-hero__title">Olá, {{ auth()->user()->name }}!</h1>
                    <p class="passageiro-hero__text">
                        Seu perfil de motorista foi criado. Assim que a empresa aprovar seu cadastro, você poderá oferecer caronas.
                    </p>
                </section>
            </div>
        </div>
    </x-slot:content>
</x-layout>
