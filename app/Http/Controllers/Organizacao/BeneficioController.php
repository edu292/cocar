<?php

namespace App\Http\Controllers\Organizacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficio;

class BeneficioController extends Controller
{
    public function create()
    {
        return view('admin.Beneficios.criar');
    }

    public function store(Request $request)
    {

        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'meta_km' => 'required|numeric|min:1',
        ], [
            'nome.required' => 'O nome do benefício é obrigatório.',
            'meta_km.required' => 'A meta de quilômetros é obrigatória.',
            'meta_km.numeric' => 'Insira um número válido para a meta de KM.',
            'meta_km.min' => 'A meta deve ser de pelo menos 1 KM.',
        ]);


        $organizacaoId = $request->user()->organizacao_id;

        if (!$organizacaoId) {return redirect()->back()->withErrors(['erro' => 'Você não está vinculado a nenhuma organização.']);}


        Beneficio::create([
            'organizacao_id' => $organizacaoId,
            'nome' => $dadosValidados['nome'],
            'descricao' => $dadosValidados['descricao'],
            'meta_km' => $dadosValidados['meta_km'],
        ]);

        return redirect()->back()
            ->with('sucesso', 'Benefício cadastrado com sucesso!');
    }
}
