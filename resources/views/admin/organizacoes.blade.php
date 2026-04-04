<x-dashboard-layout>
    <x-slot:title>Usuários</x-slot:title>
    <x-slot:content>
        <div class="users-layout">
            <div class="users-layout__main">
                <form class="card card--stretch card--flush-bottom">
                    <div class="field">
                        <div class="field__input-wrapper">
                            <div class="field__input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z" />
                                </svg>
                            </div>
                            <input type="text" name="pesquisa" placeholder="Buscar por nome, domínio ou cnpj"
                                value="{{ request('pesquisa') }}">
                            <button type="submit" class="btn btn--blue search-bar__btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.05-.35 2.025T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="card card--stretch card--no-pad">
                    <table class="table">
                        <thead>
                            <tr class="table__row table__row--head">
                                <th class="table__cell table__cell--head">Nome</th>
                                <th class="table__cell table__cell--head">Domínio Email</th>
                                <th class="table__cell table__cell--head">CNPJ</th>
                                <th class="table__cell table__cell--head">Quantidade Usuários</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($organizacoes as $organizacao)
                                <tr class="table__row">
                                    <td class="table__cell">{{ $organizacao->nome }}</td>
                                    <td class="table__cell">{{ $organizacao->dominio_email }}</td>
                                    <td class="table__cell">{{ $organizacao->cnpj }}</td>
                                    <td class="table__cell">{{ $organizacao->integrantes_count }}</td>
                                </tr>
                            @empty
                                <tr class="table__row">
                                    <td class="table__cell table__cell--empty" colspan="4">Nenhuma Organização
                                        Encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-dashboard-layout>
