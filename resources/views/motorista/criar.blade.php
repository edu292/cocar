<x-home-layout mode="motorista">
    <x-slot:title>Criar Grupo de Carona</x-slot:title>
    <x-slot:content>
        <!-- MODIFICADO: Refatorado para usar o layout padrao e classes css do projeto -->
        <section class="card card--home">
            <h3 class="card__heading card__heading--small text-blue">Criar Grupo de Carona</h3>

            <form action="{{ route('motorista.grupos.store') }}" method="POST" class="route-builder">
                @csrf

                <div class="field">
                    <label class="field__label" for="nome" style="font-weight:bold; margin-bottom:5px; display:block;">Nome do Grupo:</label>
                    <div class="field__input-wrapper">
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
                    </div>
                    @error('nome') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field" style="margin-top: 15px;">
                    <label class="field__label" for="frequencia" style="font-weight:bold; margin-bottom:5px; display:block;">Frequência:</label>
                    <div class="field__input-wrapper">
                        <!-- MODIFICADO: JS inline robusto para evitar bloqueios de frameworks SPA -->
                        <select name="frequencia" id="frequencia" required style="width:100%; border:none; outline:none; background:transparent;" onchange="document.getElementById('semanal_fields').style.display = this.value === 'semanal' ? 'block' : 'none'; document.getElementById('mensal_fields').style.display = this.value === 'mensal' ? 'block' : 'none';">
                            <option value="">Selecione...</option>
                            <option value="semanal" {{ old('frequencia') == 'semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="mensal" {{ old('frequencia') == 'mensal' ? 'selected' : '' }}>Mensal</option>
                        </select>
                    </div>
                    @error('frequencia') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <!-- MODIFICADO: Campos dinâmicos para os dias da semana -->
                <div class="field" id="semanal_fields" style="margin-top: 15px; display: {{ old('frequencia') == 'semanal' ? 'block' : 'none' }};">
                    <label class="field__label" style="font-weight:bold; margin-bottom:5px; display:block;">Dias da Semana:</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        @foreach(['seg'=>'Segunda', 'ter'=>'Terça', 'qua'=>'Quarta', 'qui'=>'Quinta', 'sex'=>'Sexta', 'sab'=>'Sábado', 'dom'=>'Domingo'] as $val => $label)
                        <label style="cursor:pointer;"><input type="checkbox" name="dias_semana[]" value="{{ $val }}" {{ in_array($val, old('dias_semana', [])) ? 'checked' : '' }}> {{ $label }}</label>
                        @endforeach
                    </div>
                    @error('dias_semana') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                    @error('dias_semana.*') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <!-- MODIFICADO: Campos dinâmicos para os dias do mês -->
                <div class="field" id="mensal_fields" style="margin-top: 15px; display: {{ old('frequencia') == 'mensal' ? 'block' : 'none' }};">
                    <label class="field__label" style="font-weight:bold; margin-bottom:5px; display:block;">Dias do Mês:</label>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        @for($i=1; $i<=31; $i++)
                        <label style="cursor:pointer; width:40px; font-size:14px;"><input type="checkbox" name="dias_mes[]" value="{{ $i }}" {{ in_array($i, old('dias_mes', [])) ? 'checked' : '' }}> {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</label>
                        @endfor
                    </div>
                    @error('dias_mes') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                    @error('dias_mes.*') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field" style="margin-top: 15px;">
                    <label class="field__label" for="vagas" style="font-weight:bold; margin-bottom:5px; display:block;">Vagas disponíveis (1 a 4):</label>
                    <div class="field__input-wrapper">
                        <input type="number" name="vagas" id="vagas" min="1" max="4" value="{{ old('vagas') }}" required style="width:100%; border:none; outline:none; background:transparent;">
                    </div>
                    @error('vagas') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field" style="margin-top: 15px;">
                    <label class="field__label" style="font-weight:bold; display:block;">Selecionar passageiros (Opcional):</label>
                    <p class="card__text card__text--left card__text--secondary" style="margin-top: 4px;">Escolha passageiros da mesma organização.</p>

                    @if($passageirosDisponiveis->isEmpty())
                        <div class="empty-state-wrapper empty-state-wrapper--compact" style="margin-top:10px;">
                            <div class="card card--empty">
                                <p>Nenhum passageiro elegível foi encontrado na sua organização.</p>
                            </div>
                        </div>
                    @else
                        <div class="trip-list" style="margin-top:10px; max-height: 280px; overflow-y: auto;">
                            @foreach($passageirosDisponiveis as $passageiro)
                                <label class="trip-card" for="passageiro-{{ $passageiro->id }}" style="cursor:pointer; flex-direction:row; justify-content:flex-start; gap:10px;">
                                    <input
                                        type="checkbox"
                                        id="passageiro-{{ $passageiro->id }}"
                                        name="passageiros[]"
                                        value="{{ $passageiro->id }}"
                                        {{ in_array($passageiro->id, old('passageiros', [])) ? 'checked' : '' }}
                                    >
                                    <div>
                                        <span style="font-weight:bold; display:block;">{{ $passageiro->name }}</span>
                                        <span class="text-text-muted" style="font-size: 14px;">{{ $passageiro->email }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    @error('passageiros') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                    @error('passageiros.*') <span class="text-orange" style="font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="route-builder__row" style="margin-top: 20px;">
                    <button type="submit" class="btn btn--green route-builder__btn">Salvar Grupo</button>
                    <a href="{{ route('motorista.home') }}" class="btn btn--outline text-blue" style="text-align:center;">Cancelar</a>
                </div>
            </form>
        </section>


    </x-slot:content>
</x-home-layout>
