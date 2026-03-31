<x-layout>
    <x-slot:title>Home</x-slot:title>

    <x-slot:body>
        <div class="min-h-screen bg-[#f4f4f5] flex flex-col items-center pt-8 px-4 pb-12">

            <header
                class="w-full max-w-4xl bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100 relative">
                <div class="h-2 w-full absolute top-0 left-0"
                    style="background: linear-gradient(90deg, var(--color-brand-blue) 0%, var(--color-brand-green) 50%, var(--color-brand-orange) 100%);">
                </div>

                <div class="px-6 py-5 mt-1 flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-16 h-16">
                            <img src="{{ asset('favicons/favicon.svg') }}" />
                        </div>
                        <span class="text-2xl font-bold text-brand-blue tracking-tight">Co<span
                                class="text-brand-orange">Car</span></span>
                    </div>
                </div>
            </header>

            <main class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden relative">

                <div class="p-8 sm:p-12">

                    <div class="mb-10 border-b border-gray-100 pb-6 flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-extrabold text-brand-blue tracking-tight">Bem-vindo(a)!</h1>
                            <p class="text-base text-brand-green mt-2 font-medium">Pronto para compartilhar sua jornada
                                hoje?</p>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 rounded-2xl p-8 border border-gray-200 flex flex-col items-center text-center">

                        <form id="logout_form" action="{{ route('logout') }}" method="POST"
                            class="w-full max-w-sm flex flex-col items-center">
                            @csrf

                            <div class="mb-6">
                                <h2 class="text-3xl font-bold text-gray-800 mb-1">Salve!</h2>
                                <p class="text-sm text-gray-500">Você está conectado à tribo.</p>
                            </div>

                            <button type="submit"
                                class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-brand-orange hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-orange transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Sair da Conta
                            </button>
                        </form>

                    </div>
                </div>

                <div class="w-full h-2 flex absolute bottom-0">
                    <div class="w-1/3 h-full bg-brand-blue"></div>
                    <div class="w-1/3 h-full bg-brand-orange"></div>
                    <div class="w-1/3 h-full bg-brand-green"></div>
                </div>

            </main>
        </div>
    </x-slot:body>
</x-layout>
