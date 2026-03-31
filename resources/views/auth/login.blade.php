<x-layout>
    <x-slot:title>Login</x-slot:title>
    <x-slot:body>
        <div class="center-wrapper">
            <div class="auth-container">
                <h1>Login</h1>

                @if (session('status'))
                    <div class="alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="formfield">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label>
                            <input type="checkbox" name="remember"> Lembrar de Mim
                        </label>
                    </div>

                    <div class="auth-form__actions">
                        <button type="submit">Login</button>
                        <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                    </div>
                </form>
            </div>
        </div>
    </x-slot:body>
</x-layout>
