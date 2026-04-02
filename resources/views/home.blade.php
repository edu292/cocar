<x-layout>
    <x-slot:title>Home</x-slot:title>
    <x-slot:body>
        <header
            class="w-full max-w-4xl bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100 relative">
            <div class="brand-stripe brand-stripe--top"></div>

            <div class="">
                <div class="logo">
                    <img src="{{ asset('favicons/favicon.svg') }}" />
                </div>
                <span class="text-blue">Co<span class="text-orange">Car</span></span>
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

                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200 flex flex-col items-center text-center">
                    <form id="logout_form" action="{{ route('logout') }}" method="POST" class="">
                        @csrf

                        <div class="mb-6">
                            <h2 class="text-3xl font-bold text-gray-800 mb-1">Salve!</h2>
                            <p class="text-sm text-gray-500">Você está conectado à tribo.</p>
                        </div>

                        <button type="submit" class="btn btn-orange">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sair da Conta
                        </button>
                    </form>
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200 flex flex-col items-center text-center">
                        <a href="{{ route('passageiro.perfil') }}" class="btn btn-blue flex items-center gap-2 mt-2">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Ver Meu Perfil
                        </a>
                    </div>
                </div>
            </div>
            <div class="brand-stripe brand-stripe--bottom"></div>
        </main>
    </x-slot:body>
</x-layout>
