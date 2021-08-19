<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }
    public function entrar(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()//redireciona pra mesma pagina com mensagem de erro
                ->back()
                ->withErrors('Usuário e/ou senha incorretos');
        }
        return redirect()->route('listar_series');//se senha e email corretos redireciona para pragina de listar series

    }
}
/*controller para o entrar*/
