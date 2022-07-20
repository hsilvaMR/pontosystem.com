<?php

namespace App\Http\Controllers\Utilizador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Home extends Controller
{

    private $dados = [];
    public function index()
    {
        $this->dados['headTitulo'] = "Home-Page";
        $this->dados['headDescricao'] = "Home";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('utilizador/pages/home', $this->dados);

    }
}
