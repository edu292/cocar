@use('App\Enums\StatusCarona')
<x-map>
    <x-slot:title>Pedido Carona</x-slot:title>
    <x-slot:content>
        <div class="bottom-panel">
            @php
                $carona = $pedidoCarona->carona;
                $status = null;
                if ($carona) {
                    $status = $carona->status;
                }
            @endphp

            @if (!$status)
                <div class="bottom-panel__header">
                    <span class="bottom-panel__title">Procurando motorista...</span>
                    <span class="bottom-panel__subtitle">Isso pode levar alguns minutos</span>
                </div>

                <form class="bottom-panel__actions"
                    action="{{ route('pedido-carona.destroy', ['pedidoCarona' => $pedidoCarona->id]) }}" method="post">
                    @method('DELETE')
                    <button class="btn btn--outline btn--red" type="sumbit">Cancelar</button>
                </form>
            @elseif ($status == StatusCarona::AGUARDANDO_EMBARQUE)
                <div class="bottom-panel__header">
                    <span class="bottom-panel__title">Motorista a caminho</span>
                    <span class="bottom-panel__subtitle">Chega em 5 minutos</span>
                </div>

                <div class="bottom-panel__profile">
                    <div class="bottom-panel__avatar">JB</div>
                    <div class="bottom-panel__info">
                        <span class="bottom-panel__name">João Batista</span>
                        <span class="bottom-panel__text">Fiat Uno Branco • ABC-1234</span>
                    </div>
                </div>
            @elseif ($status == StatusCarona::EM_ANDAMENTO)
                <div class="bottom-panel__header">
                    <span class="bottom-panel__title">A caminho do destino</span>
                    <span class="bottom-panel__subtitle">Chegada prevista às 14:30</span>
                </div>

                <div class="bottom-panel__actions">
                    <button class="btn btn--outline btn--blue" type="button">Compartilhar Rota</button>
                </div>
            @endif

            @if ($status)
                <script>
                    map.on('load', async () => {
                        const res = await fetch(
                            "{{ route('trajeto.rota', ['trajeto' => $pedidoCarona->carona->trajeto]) }}");
                        const trajeto = await res.json();
                        atualizarRota(trajeto);
                    });
                </script>
            @endif
        </div>
        <script>
            map.on('load', () => {
                new maplibregl.Marker().setLngLat(@json($pedidoCarona->origem)).addTo(map);
                new maplibregl.Marker().setLngLat(@json($pedidoCarona->destino)).addTo(map);
            })
        </script>
    </x-slot:content>
</x-map>
