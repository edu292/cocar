<x-layout>
    <x-slot:title>Registrar empresa</x-slot:title>
    <x-slot:content>
        <div class="center-wrapper bg-grafismo">
            <div class="card card--auth">
                <div class="brand-stripe brand-stripe--top"></div>

                <header class="card__header">
                    <h1 class="card__heading text-blue">
                        Traga sua <span class="text-orange">empresa</span> para <span class="text-orange">CoCar</span>
                    </h1>
                    <p class="card__subtitle text-green">
                        Menos gastos com infraestrutura, mais conexão entre funcionários e menos emissão de poluentes.
                    </p>
                </header>

                <form action="{{ route('registrar-empresa') }}" method="post" class="form">
                    @csrf

                    <fieldset>
                        <div class="field">
                            <label for="empresa-nome">Nome da empresa</label>
                            <div class="field__input-wrapper">
                                <input type="text" name="empresa-nome" id="empresa-nome"
                                    value="{{ old('empresa-nome') }}" placeholder="Nome da sua empresa" required>
                            </div>
                            @error('empresa-nome')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="cnpj">CNPJ</label>
                            <div class="field__input-wrapper">
                                <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}"
                                    placeholder="CNPJ da sua empresa" required>
                            </div>
                            @error('cnpj')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="dominio-email">Domínio de e-mail</label>
                            <div class="field__input-wrapper">
                                <input type="text" id="dominio-email" name="dominio-email"
                                    value="{{ old('dominio-email') }}" placeholder="empresa.com.br" required>
                            </div>
                            @error('dominio-email')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="field">
                            <label for="administrador-nome">Nome do responsável</label>
                            <div class="field__input-wrapper">
                                <input type="text" id="administrador-nome" name="administrador-nome"
                                    value="{{ old('administrador-nome') }}" placeholder="Nome do responsável" required>
                            </div>
                            @error('administrador-nome')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="administrador-email">E-mail do responsável</label>
                            <div class="field__input-wrapper">
                                <input type="email" id="administrador-email" name="administrador-email"
                                    value="{{ old('administrador-email') }}" placeholder="responsavel@empresa.com.br"
                                    required>
                            </div>
                            @error('administrador-email')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="administrador-cpf">CPF Responsável</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M22 3H2c-1.09.04-1.96.91-2 2v14c.04 1.09.91 1.96 2 2h20c1.09-.04 1.96-.91 2-2V5a2.074 2.074 0 0 0-2-2m0 16H2V5h20zm-8-2v-1.25c0-1.66-3.34-2.5-5-2.5s-5 .84-5 2.5V17zM9 7a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 9 12a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 9 7m5 0v1h6V7zm0 2v1h6V9zm0 2v1h4v-1z" />
                                    </svg>
                                </div>
                                <input type="text" id="administrador-cpf" name="administrador-cpf"
                                    value="{{ old('admininistrador-cpf') }}" placeholder="CPF Responsável" required>
                            </div>
                            @error('administrador-cpf')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="field">
                            <label for="password">Senha do responsável</label>
                            <div class="field__input-wrapper">
                                <input type="password" id="password" name="password" required
                                    placeholder="Crie uma senha forte">
                            </div>
                            @error('password')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Confirmar senha</label>
                            <div class="field__input-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    placeholder="Repita a senha">
                            </div>
                        </div>
                    </fieldset>

                    <button class="btn btn--orange btn--submit" type="submit">Cadastrar</button>
                </form>

                <div class="brand-stripe brand-stripe--bottom"></div>
            </div>
        </div>
    </x-slot:content>
</x-layout>
