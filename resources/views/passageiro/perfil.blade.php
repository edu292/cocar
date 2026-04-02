<x-layout>
    <x-slot:title>CoCar - Meu perfil</x-slot:title>

    <x-slot:body>
        <div class="passageiro-page bg-grafismo">
            <div class="passageiro-shell">
                <section class="passageiro-hero">
                    <div class="brand-stripe brand-stripe--top"></div>
                    <p class="passageiro-hero__eyebrow">Meu perfil</p>
                    <h1 class="passageiro-hero__title">Perfil do passageiro</h1>
                    <p class="passageiro-profile__intro">
                        Mantenha seus dados atualizados para usar a plataforma com segurança e sem bloqueios no cadastro.
                    </p>
                </section>

                <section class="passageiro-profile">
                    <div class="passageiro-profile__panel">
                        @if (session('success'))
                            <div class="feedback feedback--success" role="status">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="feedback feedback--error" role="alert">
                                <strong>Revise os dados informados.</strong>
                                <ul class="feedback__list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('passageiro.update') }}" method="POST" class="passageiro-form">
                            @csrf
                            @method('PUT')

                            <div class="passageiro-profile__group">
                                <div class="field">
                                    <label for="name">Nome completo</label>
                                    <div class="field__input-wrapper">
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="cpf">CPF</label>
                                    <div class="field__input-wrapper">
                                        <input
                                            type="text"
                                            name="cpf"
                                            id="cpf"
                                            inputmode="numeric"
                                            maxlength="11"
                                            value="{{ old('cpf', $passageiro->cpf ?? '') }}"
                                            placeholder="Digite os 11 números"
                                            required
                                        >
                                    </div>
                                    <p class="field__help">Use somente números. Esse dado é usado para identificar sua conta.</p>
                                </div>
                            </div>

                            <div class="passageiro-profile__actions">
                                <a href="{{ route('home') }}" class="passageiro-profile__back-link">Voltar ao painel</a>
                                <button type="submit" class="btn btn--blue">Salvar alterações</button>
                            </div>
                        </form>
                    </div>

                    <aside class="passageiro-profile__aside" aria-label="Resumo do cadastro">
                        <div class="passageiro-profile__meta">
                            <span class="passageiro-profile__meta-label">E-mail da conta</span>
                            <strong class="passageiro-profile__meta-value">{{ $user->email }}</strong>
                            <p class="passageiro-profile__intro">
                                O e-mail vem do cadastro principal e não pode ser alterado por esta tela.
                            </p>
                        </div>

                        <div class="passageiro-profile__meta">
                            <span class="passageiro-profile__meta-label">Status do perfil</span>
                            <strong class="passageiro-profile__meta-value">
                                {{ filled($passageiro->cpf) ? 'Cadastro completo' : 'Cadastro pendente' }}
                            </strong>
                            <p class="passageiro-profile__intro">
                                Quando seus dados estão corretos, o fluxo de uso da área do passageiro fica mais estável.
                            </p>
                        </div>
                    </aside>
                </section>
            </div>
        </div>
    </x-slot:body>
</x-layout>
