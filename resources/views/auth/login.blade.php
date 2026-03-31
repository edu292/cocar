<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoCar - Login</title>
    <!-- Importando Tailwind via CDN para prototipagem rápida -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cocar-blue': '#365691',
                        'cocar-orange': '#be602d',
                        'cocar-green': '#7b9d78',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Padrão geométrico inspirado em grafismos indígenas */
        .bg-grafismo {
            background-color: #f4f4f5;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 0L40 20L20 40L0 20L20 0z' fill='%23365691' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* Detalhe do topo simulando as cores do Cocar */
        .cocar-header-border {
            background: linear-gradient(90deg, #365691 0%, #7b9d78 50%, #be602d 100%);
        }
    </style>
</head>
<body class="bg-grafismo min-h-screen flex items-center justify-center p-4">

<!-- Container Principal do Login -->
<div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative">

    <!-- Faixa superior colorida (Conceito Cocar) -->
    <div class="w-full h-2 flex">
        <div class="w-1/3 h-full bg-cocar-blue"></div>
        <div class="w-1/3 h-full bg-cocar-orange"></div>
        <div class="w-1/3 h-full bg-cocar-green"></div>
    </div>

    <div class="p-8">
        <!-- Logo / Identidade Visual -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-cocar-blue/10 mb-4 relative">
                <!-- Ícone estilizado remetendo a um Cocar/Coroa de Penas -->
                <img src="{{asset('favicons/favicon.svg')}}">

            </div>
            <h1 class="text-3xl font-bold text-cocar-blue tracking-tight">Co<span class="text-cocar-green">Car</span></h1>
            <p class="text-sm text-cocar-green font-medium mt-1">Sua carona, nossa tribo.</p>
        </div>

        <!-- Formulário de Login -->
        <form action="#" method="POST" class="space-y-6">

            <!-- Input E-mail -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <input type="email" id="email" name="email" required
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cocar-green focus:border-cocar-green sm:text-sm transition-colors duration-200 outline-none"
                           placeholder="cacique@tribo.com">
                </div>
            </div>

            <!-- Input Senha -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <a href="#" class="text-xs font-semibold text-cocar-orange hover:text-orange-700 transition-colors">Esqueceu a senha?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cocar-green focus:border-cocar-green sm:text-sm transition-colors duration-200 outline-none"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Botão de Login -->
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-cocar-orange hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cocar-orange transition-all duration-200 transform hover:-translate-y-0.5">
                    Entrar na Tribo
                </button>
            </div>
        </form>

        <!-- Separador -->
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
                <a href="{{url('register')}}" class="w-full flex justify-center py-2.5 px-4 border-2 border-cocar-blue rounded-lg shadow-sm text-sm font-bold text-cocar-blue bg-white hover:bg-cocar-blue hover:text-white transition-all duration-200">
                    Criar uma conta
                </a>
            </div>
        </div>

    </div>

    <!-- Detalhe inferior (Grafismo indígena com borda CSS) -->
    <div class="w-full h-2 flex">
        <div class="w-1/3 h-full bg-cocar-blue"></div>
        <div class="w-1/3 h-full bg-cocar-orange"></div>
        <div class="w-1/3 h-full bg-cocar-green"></div>
    </div>
</div>

</body>
</html>
