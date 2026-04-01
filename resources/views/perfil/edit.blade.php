<x-layout>
    <x-slot:title>
        Meu Perfil - cocar
    </x-slot:title>

    <x-slot:body>
        <div class="perfil-container container mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Editar Perfil</h1>

            @if(session('sucesso'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('sucesso') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('perfil.update') }}" method="POST" class="max-w-lg bg-white p-6 rounded-lg shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Tipo de Conta (Role)</label>
                    <input type="text" value="{{ $user->role }}" disabled
                           class="w-full bg-gray-100 text-gray-500 rounded-md p-2 border cursor-not-allowed">
                </div>

                <div class="mb-6 border-t pt-4">
                    <label class="block font-medium text-gray-700">Nova Senha (deixe em branco para não alterar)</label>
                    <input type="password" name="password"
                           class="w-full border-gray-300 rounded-md shadow-sm p-2 border">
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        Salvar Alterações
                    </button>
                    <a href="{{ url('/home') }}" class="text-gray-600 hover:underline">Voltar</a>
                </div>
            </form>
        </div>
    </x-slot:body>
</x-layout>
