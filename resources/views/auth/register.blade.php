<x-layout>
    <x-slot:title>Cadastro</x-slot:title>
    <x-slot:body>
        <div class="center-wrapper">
            <div class="auth-container">
                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    <h1>Cadastro</h1>

                    @csrf

                    <div class="formfield">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Seu Nome Completo" required autofocus>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Seu Email da Instituição Parceira" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Senha da sua Conta" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirme sua Senha"required>
                    </div>

                    <div class="auth-form__actions">
                        <button type="submit">Cadastrar</button>
                        <a href="{{ route('login') }}">Já possui uma conta?</a>
                    </div>
                </form>
            </div>
        </div>
    </x-slot:body>
</x-layout>
