<x-layout>
    <x-slot:content>
        <div class="center-wrapper">
            <div class="auth-container">
                <h1>Reset Password</h1>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="formfield">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}"
                            required autofocus>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="password">Nova senha</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="formfield">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="form-form__actions">
                        <button type="submit">Redefinir Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot:content>
</x-layout>
