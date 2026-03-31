<x-layout>
    <x-slot:title>Login</x-slot:title>
    <x-slot:body>
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative">

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
                        <h1 class="text-3xl font-bold text-brand-blue tracking-tight">Co<span
                                class="text-brand-green">Car</span></h1>
                        <p class="text-sm text-brand-green font-medium mt-1">Sua carona, nossa tribo.</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 @error('email') text-red-400 @else text-gray-400 @enderror"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    autofocus
                                    class="block w-full pl-10 pr-3 py-2.5 border @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-brand-green focus:border-brand-green @enderror rounded-lg focus:ring-2 sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="cacique@tribo.com">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                <a href="#"
                                    class="text-xs font-semibold text-brand-orange hover:text-orange-700 transition-colors">Esqueceu
                                    a senha?</a>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 @error('password') text-red-400 @else text-gray-400 @enderror"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required
                                    class="block w-full pl-10 pr-3 py-2.5 border @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-brand-green focus:border-brand-green @enderror rounded-lg focus:ring-2 sm:text-sm transition-colors duration-200 outline-none"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-brand-orange hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-orange transition-all duration-200 transform hover:-translate-y-0.5">
                                Entrar na Tribo
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Novo por aqui?</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ url('register') }}"
                                class="w-full flex justify-center py-2.5 px-4 border-2 border-brand-blue rounded-lg shadow-sm text-sm font-bold text-brand-blue bg-white hover:bg-brand-blue hover:text-white transition-all duration-200">
                                Criar uma conta
                            </a>
                        </div>
                    </div>

                </div>

                <div class="w-full h-2 flex">
                    <div class="w-1/3 h-full bg-brand-blue"></div>
                    <div class="w-1/3 h-full bg-brand-orange"></div>
                    <div class="w-1/3 h-full bg-brand-green"></div>
                </div>
            </div>
        </div>
    </x-slot:body>
</x-layout>
