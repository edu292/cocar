    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class CarteiraController extends Controller
    {
        public function exibir(Request $request){
            $carteira = $request->user()->carteira;
            return view('usuario.carteira', compact('carteira'));
        }

        public function inserir(Request $request){
            $validate = $request->validate(['valor' => 'required|min:0|decimal:']);
            $carteira = $request->user()->carteira;

            $carteira->Saldo_atual += $validate['valor'];

            $carteira->save();
            return back();
        }
    }
