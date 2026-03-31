<x-layout>
    <x-slot:title>CoCar - Início</x-slot:title>

    <x-slot:body>
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden relative text-center">

            <div class="w-full h-2 flex">
                <div class="w-1/3 h-full bg-cocar-blue"></div>
                <div class="w-1/3 h-full bg-cocar-orange"></div>
                <div class="w-1/3 h-full bg-cocar-green"></div>
            </div>

            <div class="p-10">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-cocar-blue/10 mb-6 relative hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('favicons/favicon.svg') }}" alt="Logo CoCar" class="w-10 h-10">
                </div>

                <h1 class="text-4xl font-extrabold text-cocar-blue tracking-tight mb-4">
                    Bem-vindo ao <span class="text-cocar-orange">CoCar</span>
                </h1>
                <p class="text-gray-600 text-base leading-relaxed mb-10">
                    A plataforma de caronas da sua tribo. Conecte-se com pessoas da sua instituição, compartilhe viagens, faça amigos e economize no dia a dia.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    
                    <a href="{{ route('login') }}" class="flex-1 flex justify-center items-center py-3 px-4 border-2 border-cocar-blue rounded-lg shadow-sm text-sm font-bold text-cocar-blue bg-white hover:bg-cocar-blue hover:text-white transition-all duration-200 transform hover:-translate-y-0.5">
                        Fazer Login
                    </a>

                    <a href="{{ route('register') }}" class="flex-1 flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-cocar-orange hover:bg-opacity-90 transition-all duration-200 transform hover:-translate-y-0.5">
                        Criar uma Conta
                    </a>
                    
                </div>
            </div>

            <div class="w-full h-2 flex mt-auto">
                <div class="w-1/3 h-full bg-cocar-blue"></div>
                <div class="w-1/3 h-full bg-cocar-orange"></div>
                <div class="w-1/3 h-full bg-cocar-green"></div>
            </div>

        </div>
    </x-slot:body>
</x-layout>