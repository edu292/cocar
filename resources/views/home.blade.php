<x-layout>
    <x-slot:title>CoCar - Home</x-slot:title>

    <x-slot:body>
        <!-- Importando Tailwind via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <div class="min-h-screen bg-[#f4f4f5] flex flex-col items-center pt-8 px-4 pb-12">

            <!-- Header / Topbar do App -->
            <header class="w-full max-w-4xl bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100 relative">
                <!-- Faixa do Cocar no topo -->
                <div class="h-2 w-full absolute top-0 left-0" style="background: linear-gradient(90deg, #365691 0%, #7b9d78 50%, #be602d 100%);"></div>

                <div class="px-6 py-5 mt-1 flex justify-between items-center">
                    <!-- Logo Miniatura -->
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#365691]/10 p-2 rounded-full">
                            <svg class="w-6 h-6 text-[#365691]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-[#365691] tracking-tight">Co<span class="text-[#be602d]">Car</span></span>
                    </div>
                </div>
            </header>

            <!-- Container Principal (Painel) -->
            <main class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden relative">

                <div class="p-8 sm:p-12">

                    <!-- Título Original: <h1> Bem vindo</h1> -->
                    <div class="mb-10 border-b border-gray-100 pb-6 flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-extrabold text-[#365691] tracking-tight">Bem-vindo(a)!</h1>
                            <p class="text-base text-[#7b9d78] mt-2 font-medium">Pronto para compartilhar sua jornada hoje?</p>
                        </div>
                    </div>

                    <!-- Card Interno de Ações / Form Original -->
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200 flex flex-col items-center text-center">

                        <form id="logout_form" action="{{ route('logout') }}" method="POST" class="w-full max-w-sm flex flex-col items-center">
                            @csrf <!-- Obrigatório para POST no Laravel -->

                            <!-- Título Original: <h1>Salve</h1> -->
                            <div class="mb-6">
                                <h2 class="text-3xl font-bold text-gray-800 mb-1">Salve!</h2>
                                <p class="text-sm text-gray-500">Você está conectado à tribo.</p>
                            </div>

                            <!-- Botão Original: <button href="..."> Botao </button> -->
                            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-[#be602d] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#be602d] transition-all duration-200 transform hover:-translate-y-0.5">
                                <!-- Ícone de Logout -->
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Sair da Conta
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Detalhe inferior (Grafismo Cores Cocar) -->
                <div class="w-full h-2 flex absolute bottom-0">
                    <div class="w-1/3 h-full bg-[#365691]"></div>
                    <div class="w-1/3 h-full bg-[#be602d]"></div>
                    <div class="w-1/3 h-full bg-[#7b9d78]"></div>
                </div>

            </main>
        </div>
    </x-slot:body>
</x-layout>
