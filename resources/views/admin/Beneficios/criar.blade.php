<x-dashboard-layout>
    <x-slot:title>Cadastrar Benefício</x-slot:title>

    <x-slot:content>
        <div class="container" style="padding: 2rem;">
            <h2 style="font-weight: bold; font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--color-brand-blue);">
                Cadastrar Novo Benefício para Motoristas
            </h2>

            @if(session('sucesso'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #34d399; font-weight: bold;">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('admin.beneficios.store') }}" method="POST">
                @csrf

                <div class="form__fields">

                    <div class="field" style="margin-bottom: 1.25rem;">
                        <label class="field__label" for="nome">Nome do Benefício (Ex: Vale Combustível R$50)</label>
                        <div class="field__input-wrapper" style="border: 1px solid #ccc; border-radius: 4px; background: white;">
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required style="width: 100%; padding: 8px;">
                        </div>
                        @error('nome') <span class="text-alert" style="font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="field" style="margin-bottom: 1.25rem;">
                        <label class="field__label" for="descricao">Descrição / Regras do Prêmio</label>
                        <div class="field__input-wrapper" style="border: 1px solid #ccc; border-radius: 4px; background: white;">
                            <textarea name="descricao" id="descricao" rows="4" style="width: 100%; padding: 8px; border: none; outline: none;">{{ old('descricao') }}</textarea>
                        </div>
                        @error('descricao') <span class="text-alert" style="font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="field" style="margin-bottom: 1.25rem;">
                        <label class="field__label" for="meta_km">Meta de Quilometragem Acumulada (KM)</label>
                        <div class="field__input-wrapper" style="border: 1px solid #ccc; border-radius: 4px; background: white;">
                            <input type="number" step="0.01" name="meta_km" id="meta_km" value="{{ old('meta_km') }}" required style="width: 100%; padding: 8px;">
                        </div>
                        <small style="color: var(--color-text-muted); display: block; margin-top: 4px;">
                            Lembrete: O progresso do motorista será calculado multiplicando o KM percorrido pela quantidade de pessoas no carro!
                        </small>
                        @error('meta_km') <span class="text-alert" style="font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn--green" style="padding: 10px 20px; color: white; border-radius: 4px; font-weight: bold;">
                        Salvar Benefício
                    </button>
                    <a href="javascript:history.back()" style="margin-left: 15px; color: var(--color-text-muted); text-decoration: none; font-weight: 500;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-dashboard-layout>
