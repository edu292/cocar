<x-layout>
    <x-slot:title>Cadastro</x-slot:title>
    <x-slot:body>
        <div class="center-wrapper bg-grafismo">
            <div class="card card--auth">
                <div class="brand-stripe brand-stripe--top"></div>

                <header class="card__header">
                    <div class="logo">
                        <img src="{{ asset('favicons/favicon.svg') }}">
                    </div>
                    <h1 class="card__heading text-blue">Junte-se à
                        <span class="text-orange">Tribo</span>
                    </h1>
                    <p class="card__subtitle text-green">Crie sua conta no CoCar
                    </p>
                </header>

                <form method="POST" action="{{ route('register') }}" class="form">
                    @csrf

                    <div class="field">
                        <label for="name">Nome</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d=" M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                autofocus placeholder="Seu Nome Completo">
                        </div>
                        @error('name')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                placeholder="Seu Email da Instituição Parceira">
                        </div>
                        @error('email')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Senha</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                placeholder="Crie uma senha forte">
                        </div>
                        @error('password')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=" M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0
                                    01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03
                                    9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="Repita a senha">
                        </div>
                    </div>
                    <div class="field">
                        <label for="role">Como você vai usar o CoCar?</label>
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <select id="role" name="role" required>
                                <option value="" disabled selected>Selecione seu perfil...</option>

                                <option value="passageiro" {{ old('role') == 'passageiro' ? 'selected' : '' }}>
                                    Quero pegar carona (Passageiro)
                                </option>
                                <option value="motorista" {{ old('role') == 'motorista' ? 'selected' : '' }}>
                                    Vou oferecer carona (Motorista)
                                </option>
                            </select>

                        </div>
                        @error('role')
                            <span class="field__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn--orange btn--submit">
                        Cadastrar
                    </button>
                </form>

                <div class="stripe-container">
                    <span>
                        Já faz parte da nossa tribo?
                    </span>
                </div>

                <a href="{{ route('login') }}" class="text-blue">
                    Faça login
                </a>

                <div class="brand-stripe brand-stripe--bottom"></div>
            </div>
        </div>
    </x-slot:body>
</x-layout>
