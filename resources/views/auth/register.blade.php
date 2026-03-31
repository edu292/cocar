<x-layout>
    <x-slot:title>CoCar - Cadastro</x-slot:title>

    <x-slot:body>
        <!-- Importando Tailwind via CDN para garantir a renderização -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Wrapper centralizado -->
        <div class="min-h-screen flex items-center justify-center p-4 bg-[#f4f4f5]">

            <!-- Container Principal do Auth -->
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative">

                <!-- Faixa superior colorida (Conceito Cocar) -->
                <div class="w-full h-2 flex mt-auto">
                    <div class="w-1/3 h-full bg-[#365691]"></div>
                    <div class="w-1/3 h-full bg-[#be602d]"></div>
                    <div class="w-1/3 h-full bg-[#7b9d78]"></div>
                </div>

                <div class="p-8">
                    <!-- Cabeçalho de Cadastro -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#365691]/10 mb-4 relative">
                            <!-- Ícone de "Novo Membro" / Adição -->
                            <img src="{{asset('favicons/favicon.svg')}}">

                        </div>
                        <h1 class="text-3xl font-bold text-[#365691] tracking-tight">Junte-se à <span class="text-[#be602d]">Tribo</span></h1>
                        <p class="text-sm text-[#7b9d78] font-medium mt-1">Crie sua conta no CoCar</p>
                    </div>

                    <!-- Formulário Laravel -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Field: Nome -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#7b9d78] focus:border-[#7b9d78] sm:text-sm transition-colors duration-200 outline-none"
                                       placeholder="Seu Nome Completo">
                            </div>
                            @error('name')
                            <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field: Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#7b9d78] focus:border-[#7b9d78] sm:text-sm transition-colors duration-200 outline-none"
                                       placeholder="Seu Email da Instituição Parceira">
                            </div>
                            @error('email')
                            <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field: Senha -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#7b9d78] focus:border-[#7b9d78] sm:text-sm transition-colors duration-200 outline-none"
                                       placeholder="Crie uma senha forte">
                            </div>
                            @error('password')
                            <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field: Confirmar Senha -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Senha</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#7b9d78] focus:border-[#7b9d78] sm:text-sm transition-colors duration-200 outline-none"
                                       placeholder="Repita a senha">
                            </div>
                        </div>

                        <!-- Botão Ação -->
                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-[#be602d] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#be602d] transition-all duration-200 transform hover:-translate-y-0.5">
                                Cadastrar
                            </button>
                        </div>
                    </form>

                    <!-- Link para Voltar ao Login -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Já faz parte da nossa tribo?
                            <a href="{{ route('login') }}" class="font-bold text-[#365691] hover:text-[#28406c] transition-colors duration-200">
                                Faça login
                            </a>
                        </p>
                    </div>

                </div>

                <!-- Detalhe inferior (Grafismo Cores) -->
                <div class="w-full h-2 flex mt-auto">
                    <div class="w-1/3 h-full bg-[#365691]"></div>
                    <div class="w-1/3 h-full bg-[#be602d]"></div>
                    <div class="w-1/3 h-full bg-[#7b9d78]"></div>
                </div>

            </div>
        </div>
    </x-slot:body>
</x-layout>
