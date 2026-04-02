<x-layout>
    <x-slot:title>Registre sua Empresa</x-slot:title>
    <x-slot:content>
        <div class="center-wrapper bg-grafismo">
            <div class="card card--auth">
                <div class="brand-stripe brand-stripe--top"></div>
                <header class="card__header">
                    <h1 class="card__heading text-blue">Traga sua <span class="text-orange">Empresa</span> para <span
                            class="text-orange">CoCar</span>
                    </h1>
                    <p class="card__subtitle text-green">Menos gastos com infraestrutura, mais conexão entre funcionários
                        e
                        menos emissão de poluentes.</p>
                </header>
                <form action="{{ route('register-company') }}" method="post" class="form">
                    @csrf
                    <fieldset>
                        <div class="field">
                            <label for="company-name">Nome Empresa</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M19 3v18h-6v-3.5h-2V21H5V3zm-4 4h2V5h-2zm-4 0h2V5h-2zM7 7h2V5H7zm8 4h2V9h-2zm-4 0h2V9h-2zm-4 0h2V9H7zm8 4h2v-2h-2zm-4 0h2v-2h-2zm-4 0h2v-2H7zm8 4h2v-2h-2zm-8 0h2v-2H7zM21 1H3v22h18z" />
                                    </svg>
                                </div>
                                <input type="text" name="company-name" id="company-name"
                                    value="{{ old('company-name') }}" placeholder="Nome da sua Empresa" required>
                            </div>
                            @error('company-name')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="cnpj">CNPJ</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12.025 4.475q2.65 0 5 1.138T20.95 8.9q.175.225.113.4t-.213.3t-.35.113t-.35-.213q-1.375-1.95-3.537-2.987t-4.588-1.038t-4.55 1.038T3.95 9.5q-.15.225-.35.25t-.35-.1q-.175-.125-.213-.312t.113-.388q1.55-2.125 3.888-3.3t4.987-1.175m0 2.35q3.375 0 5.8 2.25t2.425 5.575q0 1.25-.887 2.088t-2.163.837t-2.187-.837t-.913-2.088q0-.825-.612-1.388t-1.463-.562t-1.463.563t-.612 1.387q0 2.425 1.438 4.05t3.712 2.275q.225.075.3.25t.025.375q-.05.175-.2.3t-.375.075q-2.6-.65-4.25-2.588T8.95 14.65q0-1.25.9-2.1t2.175-.85t2.175.85t.9 2.1q0 .825.625 1.388t1.475.562t1.45-.562t.6-1.388q0-2.9-2.125-4.875T12.05 7.8T6.975 9.775t-2.125 4.85q0 .6.113 1.5t.537 2.1q.075.225-.012.4t-.288.25t-.387-.012t-.263-.288q-.375-.975-.537-1.937T3.85 14.65q0-3.325 2.413-5.575t5.762-2.25m0-4.8q1.6 0 3.125.387t2.95 1.113q.225.125.263.3t-.038.35t-.25.275t-.425-.025q-1.325-.675-2.738-1.037t-2.887-.363q-1.45 0-2.85.338T6.5 4.425q-.2.125-.4.063t-.3-.263t-.05-.362t.25-.288q1.4-.75 2.925-1.15t3.1-.4m0 7.225q2.325 0 4 1.563T17.7 14.65q0 .225-.137.363t-.363.137q-.2 0-.35-.137t-.15-.363q0-1.875-1.388-3.137t-3.287-1.263t-3.262 1.263T7.4 14.65q0 2.025.7 3.438t2.05 2.837q.15.15.15.35t-.15.35t-.35.15t-.35-.15q-1.475-1.55-2.262-3.162T6.4 14.65q0-2.275 1.65-3.838t3.975-1.562M12 14.15q.225 0 .363.15t.137.35q0 1.875 1.35 3.075t3.15 1.2q.15 0 .425-.025t.575-.075q.225-.05.388.063t.212.337q.05.2-.075.35t-.325.2q-.45.125-.787.138t-.413.012q-2.225 0-3.863-1.5T11.5 14.65q0-.2.138-.35t.362-.15" />
                                    </svg>
                                </div>
                                <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}"
                                    placeholder="CNPJ da sua Empresa" required>
                            </div>
                            @error('cnpj')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="email-domain">Domínio de Email</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path
                                                d="M3.338 17A10 10 0 0 0 12 22a10 10 0 0 0 8.662-5M3.338 7A10 10 0 0 1 12 2a10 10 0 0 1 8.662 5" />
                                            <path
                                                d="M13 21.95s1.408-1.853 2.295-4.95M13 2.05S14.408 3.902 15.295 7M11 21.95S9.592 20.098 8.705 17M11 2.05S9.592 3.902 8.705 7M9 10l1.5 5l1.5-5l1.5 5l1.5-5M1 10l1.5 5L4 10l1.5 5L7 10m10 0l1.5 5l1.5-5l1.5 5l1.5-5" />
                                        </g>
                                    </svg>
                                </div>
                                <input type="text" id="email-domain" name="email-domain"
                                    value="{{ old('email-domain') }}" placeholder="domínio.com da sua Empresa" required>
                            </div>
                            @error('email-domain')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="field">
                            <label for="admin-name">Nome Responsável</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                        viewBox="0 0 36 36">
                                        <path fill="currentColor"
                                            d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75a6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76a4.76 4.76 0 0 0-4.76-4.76"
                                            class="clr-i-outline clr-i-outline-path-1" />
                                        <path fill="currentColor"
                                            d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.8 14.8 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z"
                                            class="clr-i-outline clr-i-outline-path-2" />
                                        <path fill="currentColor" d="M26.87 16.29a.4.4 0 0 1 .15 0a.4.4 0 0 0-.15 0"
                                            class="clr-i-outline clr-i-outline-path-3" />
                                        <path fill="currentColor"
                                            d="m33.68 23.32l-2-.61a7.2 7.2 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7 7 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.8 6.8 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7 7 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a7 7 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28"
                                            class="clr-i-outline clr-i-outline-path-4" />
                                        <path fill="none" d="M0 0h36v36H0z" />
                                    </svg>
                                </div>
                                <input type="text" id="admin-name" name="admin-name" value="{{ old('admin-name') }}"
                                    placeholder="Nome Resposável" required>
                            </div>
                            @error('admin-name')
                                <span class="field__error">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="field">
                            <label for="admin-email">Email Responsável</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" id="admin-email" name="admin-email"
                                    value="{{ old('admin-email') }}" placeholder="Email Responsável" required>
                            </div>
                            @error('admin-email')
                                <span class="field__error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="password">Senha Responsável</label>
                            <div class="field__input-wrapper">
                                <div class="field__input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    <input type="password" id="password" name="password" required
                                        placeholder="Crie uma senha forte">
                                </div>
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
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    required placeholder="Repita a senha">
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
