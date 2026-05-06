<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrupoCaronaController extends Controller
{
    public function create()
    {
        return view('motorista.criar');
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'frequencia' => 'required|in:semanal,mensal',
            'vagas' => 'required|integer|min:1|max:4',
        ]);

        $motorista = $request->user()->perfilMotorista;
        $motorista->grupos()->create($dadosValidados);

        //Usei a IA pra fazer isso aqui pq YO NO SABO
        return redirect()->route('motorista.home')
            ->with('sucesso', 'Grupo de carona criado com sucesso!');

    }


}
