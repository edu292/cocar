<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller{

    public function edit(){
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();
        request()->validate([
           'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user -> id,
            'password' => 'nullable|string|min:8',
        ]);

        $dados = $request->only(['name', 'email']);

        if($request->filled('password')){
            $dados['password'] = Hash::make($request->password);
        }

        $user->update($dados);

        return redirect() -> back() -> with('successo', 'Perfil atualizado com sucesso!');
    }

    function destroy(Request $request){
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/') -> with('successo', 'Perfil excluido com sucesso!');

    }


}
