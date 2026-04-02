<x-layout>
    <x-slot:title>Criar perfil do passageiro - CoCar</x-slot:title>

    <x-slot:body>
        <div class="passageiro-page bg-grafismo">
            <section class="passageiro-form-card passageiro-form-card--compact">
                <div class="brand-stripe brand-stripe--top"></div>

                <header class="passageiro-form-header">
                    <p class="passageiro-form-header__eyebrow">Primeiro acesso</p>
                    <h1 class="passageiro-form-header__title">Complete seu perfil de passageiro</h1>
                    <p class="passageiro-form-header__text">
                        Precisamos do seu CPF para liberar o uso completo da área do passageiro.
                    </p>
                </header>

                @if ($errors->any())
                    <div class="feedback feedback--error" role="alert">
                        <strong>Não foi possível salvar.</strong>
                        <ul class="feedback__list">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('passageiro.store') }}" class="passageiro-form">
                    @csrf

                    <div class="field">
                        <label for="cpf">CPF</label>
                        <div class="field__input-wrapper">
                            <input
                                type="text"
                                id="cpf"
                                name="cpf"
                                inputmode="numeric"
                                maxlength="11"
                                value="{{ old('cpf') }}"
                                placeholder="Digite os 11 números"
                                required
                            >
                        </div>
                        <p class="field__help">Digite somente números, sem pontos ou traços.</p>
                    </div>

                    <button type="submit" class="btn btn--blue btn--submit">Salvar perfil</button>
                </form>

                <div class="brand-stripe brand-stripe--bottom"></div>
            </section>
        </div>
    </x-slot:body>
</x-layout>
