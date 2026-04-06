<x-layout>
    <x-slot:title>Carteira</x-slot:title>
    <x-slot:body>
        <div class="app-layout bg-grafismo">
            <main class="app-layout__content center-wrapper">

                <div class="card card--wallet">
                    <div class="brand-stripe brand-stripe--top"></div>

                    <div class="card__header card__header--wallet">
                        <h1 class="card__heading card__heading--small text-blue">Saldo Atual</h1>
                        <div class="stats-grid__value text-green wallet__balance">{{$carteira -> $Saldo_atual}}</div>
                    </div>

                    <form action="{{route('usuario.carteira.inserir')}}" method="POST" class="form">
                        @csrf
                        @method('PUT')
                        <h2 class="wallet__section-title">Adicionar Saldo</h2>

                        <div class="wallet__presets" id="val_preset">
                            <button type="button" class="btn btn--outline btn--green" data-valor = '10'>R$ 10</button>
                            <button type="button" class="btn btn--outline btn--green" data-valor = '25'>R$ 25</button>
                            <button type="button" class="btn btn--outline btn--green" data-valor = '50'>R$ 50</button>
                        </div>

                        <div class="stripe-container">
                            <span>ou</span>
                        </div>

                        <div class="field">
                            <div class="field__input-wrapper">
                                <div class="field__input-icon field__input-icon--text">R$</div>
                                <input type="number" name="valor" id="valor" step="0.01" min="0.01" placeholder="Outrovalor" >
                            </div>
                        </div>

                        <button type="submit" class="btn btn--blue btn--submit">Inserir Saldo</button>
                    </form>
                </div>

            </main>

        </div>
        <script>
            const valores_preset = document.getElementById('val_preset')
            const valor_input = document.getElementById('valor')

            valores_preset.addEventListener('click', (event) => {
                botao = event.target.closest('button')
                valor_input.value = botao.dataset.valor
            } )
        </script>
    </x-slot:body>
</x-layout>
