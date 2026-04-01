<x-layout>
    <x-slot:title>
        Editar Perfil - CoCar
    </x-slot:title>

    <x-slot:body>
        <div class="center-wrapper bg-grafismo">
            <div class="card card--auth">
                <div class="brand-stripe brand-stripe--top"></div>

                <header class="card__header">
                    <div class="logo">
                        <img src="{{ asset('favicons/favicon.svg') }}" alt="CoCar Logo" />
                    </div>
                    <h1 class="card__heading text-blue">Meu <span class="text-orange">Perfil</span></h1>
                    <p class="text-brand-green">Mantenha seus dados atualizados na tribo.</p>
                </header>

                @if(session('sucesso'))
                    <div style="color: var(--color-brand-green); margin-bottom: 20px; font-weight: bold;">
                        {{ session('sucesso') }}
                    </div>
                @endif

                <form action="{{ route('perfil.update') }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label class="text-blue font-bold">Nome</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name') <span class="field__error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold">E-mail</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email') <span class="field__error">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold">Tipo de Conta</label>
                        <div class="field__input-wrapper" style="background-color: #f9f9f9; opacity: 0.7;">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input type="text" value="{{ $user->role }}" disabled style="cursor: not-allowed;">
                        </div>
                    </div>

                    <div class="stripe-container">
                        <span>Segurança</span>
                    </div>

                    <div class="field">
                        <label class="text-blue font-bold">Nova Senha</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" placeholder="Deixe em branco para não alterar">
                        </div>
                        @error('password') <span class="field__error">{{ $message }}</span> @enderror
                    </div>

                    <div class="card__actions">
                        <button type="submit" class="btn btn--blue">
                            Salvar Alterações
                        </button>
                        <a href="{{ url('/home') }}" class="btn btn--outline btn--blue">
                            Voltar
                        </a>
                    </div>
                </form>

                <div class="brand-stripe brand-stripe--bottom"></div>
            </div>
        </div>
    </x-slot:body>
</x-layout>
