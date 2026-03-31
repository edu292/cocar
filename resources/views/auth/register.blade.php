<x-layout>
    <x-slot:title>Cadastro</x-slot:title>
    <x-slot:body>
        <div class="min-h-screen flex items-center justify-center p-4"">
            <main class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative">
                <div class="w-full h-2 flex">
                    <div class="w-1/3 h-full bg-brand-blue"></div>
                    <div class="w-1/3 h-full bg-brand-orange"></div>
                    <div class="w-1/3 h-full bg-brand-green"></div>
                </div>

                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 relative">
                            <img src="{{ asset('favicons/favicon.svg') }}">
                        </div>
                        <h1 class="text-3xl font-bold text-brand-blue tracking-tight">Junte-se à
                            <span class="text-brand-orange">Tribo</span>
                        </h1>
                        <p class="text-sm text-brand-green font-medium mt-1">Crie sua conta no CoCar
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    autofocus
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green focus:border-brand-green sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="Seu Nome Completo">
                            </div>
                            @error('name')
                                <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green focus:border-brand-green sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="Seu Email da Instituição Parceira">
                            </div>
                            @error('email')
                                <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green focus:border-brand-green sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="Crie uma senha forte">
                            </div>
                            @error('password')
                                <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-1">Confirmar
                                Senha</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green focus:border-brand-green sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="Repita a senha">
                            </div>
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Como
                                você vai usar
                                o CoCar?</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <select id="role" name="role" required
                                    class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cocar-green focus:border-cocar-green sm:text-sm transition-colors duration-200 outline-none appearance-none bg-white">
                                    <option value="" disabled selected>Selecione seu perfil...
                                    </option>

                                    <option value="passageiro" {{ old('role') == 'passageiro' ? 'selected' : '' }}>
                                        Quero pegar
                                        carona (Passageiro)</option>
                                    <option value="motorista" {{ old('role') == 'motorista' ? 'selected' : '' }}>
                                        Vou oferecer
                                        carona (Motorista)</option>

                                </select>

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('role')
                                <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror


                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-brand-orange hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-orange transition-all duration-200 transform hover:-translate-y-0.5">
                                    Cadastrar
                                </button>
                            </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Já faz parte da nossa tribo?
                            <a href="{{ route('login') }}"
                                class="font-bold text-brand-blue hover:text-[#28406c] transition-colors duration-200">
                                Faça login
                            </a>
                        </p>
                    </div>
                </div>
        </div>

        <div class="w-full h-2 flex mt-auto">
            <div class="w-1/3 h-full bg-brand-blue"></div>
            <div class="w-1/3 h-full bg-brand-orange"></div>
            <div class="w-1/3 h-full bg-brand-green"></div>
        </div>
        </main>
        </div>
    </x-slot:body>
</x-layout>
