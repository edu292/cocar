<x-layout>
    <x-slot:title>CoCar</x-slot:title>
    <x-slot:body>
        <nav>
            <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Cadastro</a></li>
            </ul>
        </nav>
        <main>
            <h1>Bem Vindo!</h1>
        </main>
    </x-slot:body>
</x-layout>
