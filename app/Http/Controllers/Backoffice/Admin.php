<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Cookie;

class Admin extends Controller
{
    private $dados = [];
    public function index()
    {
        $this->dados['headTitulo'] = "Gestão de Utilizadores";
        $this->dados['headDescricao'] = "Area de Utilizadores";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('backoffice/pages/admin', $this->dados);
    }

    public function show()
    {
        if (Cookie::get('admin_cookie') != null) {
            
            $email = json_decode(\Cookie::get('admin_cookie'))->email;
            $this->dados['headTitulo'] = "Minha Conta";
            $this->dados['headDescricao'] = "My Profile";
            $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
            $this->dados['user'] =  \DB::table('utilizador')->where('email', $email)->first();
            $this->dados['tipo'] = "show";

            return view('backoffice/pages/admin-add', $this->dados);
        }

        return redirect()->route('pageDashboard');

    }
    public function edit($id)
    {
        $this->dados['headTitulo'] = "Gestão de Utilizadores";
        $this->dados['headDescricao'] = "Area de Utilizadores";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['tipo'] = "editM";
        $this->dados['user'] =  \DB::table('utilizador')->where('id', $id)->first();

        return view('backoffice/pages/admin-edit', $this->dados);
    }

    public function editPost()
    {
    }

    public function delet($id)
    {
    }
}
