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
                                    value="{{ old('administrador-email') }}" placeholder="responsavel@empresa.com.br" required>
                            </div>
                            @error('administrador-email')
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
