@foreach ($sugestoes as $sugestao)
    <div class="map-popup" data-coord="@json($sugestao->origem)">
        <div class="map-popup__header">
            <span class="map-popup__title">{{ $sugestao->user->name }}</span>
            <span class="map-popup__info">Desvio (Metros): {{ $sugestao->desvio_metros }}</span>
        </div>
        <div class="map-popup__actions">
            <form class="action-form"
                hx-post="{{ route('trajeto.criar-carona', ['trajeto' => request()->route('trajeto'), 'pedidoID' => $sugestao->id]) }}"
                hx-swap="outerHTML">
                <button class="btn btn--blue" type="submit">Adicionar</button>
            </form>
        </div>
    </div>
@endforeach
