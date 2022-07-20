<?php

namespace App\Http\Controllers\Utilizador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use File;
use App\Mail\MailTest;

class UserArea extends Controller
{
    private $dados = [];

    public function index()
    {

        $this->dados['headTitulo'] = "Area Cliente";
        $this->dados['headDescricao'] = "Home";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['modulo'] = "CL";

        $id = json_decode(\Cookie::get('user_cookie'))->id;

        $pontos = \DB::table('ponto')->where('id_utilizador', $id)->orderBy('id', 'DESC')->get();
        $ponto = [];

        foreach ($pontos as $item) {

            $ponto[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'inicio' => $item->hora_inicio,
                'fim' => $item->hora_fim,
                'data' => $item->data,
                'total' => $item->total,
            ];
        }
        $this->dados['pontos'] = $ponto;

        return view('areaUser/dashboard', $this->dados);
    }
    public function myProfile()
    {
        if (Cookie::get('user_cookie') != null) {

            $email = json_decode(\Cookie::get('user_cookie'))->email;
            $this->dados['headTitulo'] = "Minha Conta";
            $this->dados['headDescricao'] = "My Profile";
            $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
            $this->dados['user'] =  \DB::table('utilizador')->where('email', $email)->first();
            $this->dados['tipo'] = "show";
            $this->dados['modulo'] = "CL";

            return view('areaUser/profile', $this->dados);
        }

        return redirect()->route('pageDashboard');
    }

    public function editProfile($id)
    {
        $this->dados['headTitulo'] = "Editar Conta";
        $this->dados['headDescricao'] = "Minha Conta Editar";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['tipo'] = "editM";
        $this->dados['user'] =  \DB::table('utilizador')->where('id', $id)->first();
        $this->dados['modulo'] = "CL";

        return view('areaUser/profile-edit', $this->dados);
    }

    public function validarFicheiroV2(Request $request, $path, $inputName)
    {

        if (filesize($request->file($inputName)) > 0) {

            $ficheiro = $request->file($inputName);
            $extensao = strtolower($ficheiro->getClientOriginalExtension());
            $extensaos = array("jpg", "JPG", "svg", "SVG", "jpeg", "JPEG", "png", "PNG");

            if (in_array($extensao, $extensaos)) {

                // verifica o tamanho do ficheiro | getSize() deveolve o tamanho em bytes
                if (filesize($request->file('uploadF')) <= 25000000) {
                    $photo = $ficheiro->getClientOriginalName();

                    $pathTemp = $ficheiro->move('backoffice/img', $ficheiro->getClientOriginalName());

                    return "addFile";
                }
                return "Tamanho do Ficheiro Não Suportado " . $ficheiro->getSize() . " byte ! Max 25MB ";
            }

            return "Extensão do Ficheiro Não Suportado!";
        }

        return "empty";
    }


    public function editPost(Request $request)
    {

        $nome = trim($request->nome);
        $email = trim($request->email);
        $userTipo = trim($request->userTipo);
        $idEdit = trim($request->idEdit);
        $photo = null;

        if (empty($nome)) {
            return "Deve Indicar o Nome ! ";
        }
        if (empty($email)) {
            return "Deve Indicar o E-mail ! ";
        }
        if (empty($userTipo)) {
            return "Deve Indicar  Tipo de Utilizador ! ";
        }

        if ($idEdit != null) {

            if (filesize($request->file('uploadF')) > 0) {

                $pathF = "public_html/pontosystem/backoffice/img/";
                $validarFile = self::validarFicheiroV2($request, $pathF, "uploadF");

                if ($validarFile == "addFile") {
                    $photo = $request->file('uploadF')->getClientOriginalName();
                } else {
                    return  $validarFile;
                }
            }

            \DB::table('utilizador')
            ->where('id', $idEdit)
                ->update([
                    'nome' => $nome,
                    'email' => $email,
                    'tipo' => $userTipo,
                    'photo' => $photo
                ]);

            return "update";
        }
        return "ID Invalido !";
    }


    public function consulta(Request $request)
    {
        // dados

        $idF = trim($request->idF);
        $mes = trim($request->selecMonth);
        $ano = trim($request->selecAno);

        if (empty($mes)) {
            return "Deve Indicar o Mês !";
        }
        if (empty($ano)) {
            return "Deve Indicar o Mês !";
        }
        if (empty($idF)) {
            return "Deve Indicar o ID Funcionario !";
        }

        $ponto = \DB::table('ponto')->where('mes', $mes)->first();

        if (empty($ponto->id_utilizador)) {
            return "Nenhum Registo Com Os Parâmetro Indicado ! ";
        }

        if (empty($ponto->ano)) {
            return "Nenhum Registo Com Os Parâmetro Indicado";
        }

        if (empty($ponto->mes)) {
            return "Nenhum Registo Encontrado Com Os Parâmetro Indicado !";
        }

        $pontos = \DB::table('ponto')
        ->where('id_utilizador', $idF)
            ->where('mes', $mes)
            ->where('ano', $ano)
            ->orderBy('id', 'DESC')->get();

        $soma = 0;

        foreach ($pontos as $item) {

            $soma += (float)$item->total;
        }

        if ($soma > 0) {
            $user = \DB::table('utilizador')->where('id', $idF)->first();
            $totalH  = number_format((float)($soma), 2, '.', '');
            $userD = [
                'id' => $user->id,
                'nome' => $user->nome,
                'total' => $totalH
            ];
            return json_encode($userD, true);
        }

        return  $soma;
    }
}
