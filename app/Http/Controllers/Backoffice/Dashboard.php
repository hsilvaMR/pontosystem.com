<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    
    public function index(){

        $this->dados['headTitulo'] = "Backoffice";
        $this->dados['headDescricao'] = "Home";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        $this->dados['num1'] = \DB::table('utilizador')->select('id')->count();
        $this->dados['num2'] = \DB::table('ponto')->select('id')->count();

        return view('backoffice/pages/dashboard', $this->dados);
    }

}
