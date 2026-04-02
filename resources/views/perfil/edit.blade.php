<x-layout>
    <x-slot:title>Editar perfil - CoCar</x-slot:title>

    <x-slot:body>
        <div class="center-wrapper bg-grafismo">
            <div class="card card--auth">
                <div class="brand-stripe brand-stripe--top"></div>

                <header class="card__header">
                    <div class="logo">
                        <img src="{{ asset('favicons/favicon.svg') }}" alt="Logo CoCar" />
                    </div>
                    <h1 class="card__heading text-blue">Meu <span class="text-orange">perfil</span></h1>
                    <p class="text-brand-green">Mantenha seus dados atualizados na tribo.</p>
                </header>

                @if (session('success'))
                    <div style="color: var(--color-brand-green); margin-bottom: 20px; font-weight: bold;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('perfil.update') }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label class="text-blue font-bold" for="name">Nome</label>
                        <div class="field__input-wrapper">
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold" for="email">E-mail</label>
                        <div class="field__input-wrapper">
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold">Tipo de conta</label>
                        <div class="field__input-wrapper" style="background-color: #f9f9f9; opacity: 0.7;">
                            <input type="text" value="{{ $user->papel->label() }}" disabled style="cursor: not-allowed;">
                        </div>
                    </div>

                    <div class="stripe-container">
                        <span>Segurança</span>
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold" for="password">Nova senha</label>
                        <div class="field__input-wrapper">
                            <input type="password" id="password" name="password" placeholder="Deixe em branco para não alterar">
                        </div>
                        @error('password')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card__actions">
                        <button type="submit" class="btn btn--blue">
                            Salvar alterações
                        </button>
                        <a href="{{ route('home') }}" class="btn btn--outline btn--blue">
                            Voltar
                        </a>
                    </div>
                </form>

                <div class="stripe-container">
                    <span>Zona de perigo</span>
                </div>

                <form action="{{ route('perfil.destroy') }}" method="POST"
                    onsubmit="return confirm('Tem certeza? Esta ação não pode ser desfeita!')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn"
                        style="--background-color: var(--color-alert-red); width: 100%; margin-top: 10px;">
                        Excluir minha conta
                    </button>
                </form>

                <div class="brand-stripe brand-stripe--bottom"></div>
            </div>
        </div>
    </x-slot:body>
</x-layout>
