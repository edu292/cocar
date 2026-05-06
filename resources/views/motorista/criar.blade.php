<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste - Criar Grupo</title>
    <style>
        /* CSS básico apenas para não ficar tudo grudado na tela */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .caixa { background: white; max-width: 500px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .campo { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .botoes { margin-top: 20px; display: flex; gap: 10px; }
        .btn-salvar { background: #10b981; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        .btn-cancelar { background: #6b7280; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; }
        .erro { color: red; font-size: 12px; margin-top: 5px; display: block; }
    </style>
</head>
<body>

<div class="caixa">
    <h2>Criar Grupo de Carona (Versão de Teste)</h2>

    <form action="{{ route('motorista.grupos.store') }}" method="POST">

        @csrf

        <div class="campo">
            <label for="nome">Nome do Grupo:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
            @error('nome') <span class="erro">{{ $message }}</span> @enderror
        </div>

        <div class="campo">
            <label for="frequencia">Frequência:</label>
            <select name="frequencia" id="frequencia" required>
                <option value="">Selecione...</option>
                <option value="semanal" {{ old('frequencia') == 'semanal' ? 'selected' : '' }}>Semanal</option>
                <option value="mensal" {{ old('frequencia') == 'mensal' ? 'selected' : '' }}>Mensal</option>
            </select>
            @error('frequencia') <span class="erro">{{ $message }}</span> @enderror
        </div>

        <div class="campo">
            <label for="vagas">Vagas disponíveis (1 a 4):</label>
            <input type="number" name="vagas" id="vagas" min="1" max="4" value="{{ old('vagas') }}" required>
            @error('vagas') <span class="erro">{{ $message }}</span> @enderror
        </div>

        <div class="botoes">
            <button type="submit" class="btn-salvar">Salvar Grupo</button>
            <a href="{{ route('motorista.home') }}" class="btn-cancelar">Voltar</a>
        </div>

    </form>
</div>

</body>
</html>
