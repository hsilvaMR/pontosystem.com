<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailTest;
use File;
use Cookie;
use Mail;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Utilizador extends Controller
{
    private $dados = [];

    public function index()
    {
        $this->dados['headTitulo'] = "Gestão de Utilizadores";
        $this->dados['headDescricao'] = "Area de Utilizadores";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['tipo'] = "gestao";

        $tblutilizadores = \DB::table('utilizador')->orderBy('id', 'DESC')->get();
        $users = [];

        foreach ($tblutilizadores as $item) {

            $users[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'email' => $item->email,
                'tipo' => $item->tipo,
                'status' => $item->status,
            ];
        }
        $this->dados['users'] = $users;
        return view('backoffice/pages/users', $this->dados);
    }

    public function add()
    {
        $this->dados['headTitulo'] = "Adicionar Utilizador";
        $this->dados['headDescricao'] = "Area de Utilizadores";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['tipo'] = "add";

        return view('backoffice/pages/users-add', $this->dados);
    }

    public function edit($id)
    {

        if ($id != null) {

            if (\DB::table('utilizador')->where('id', $id)->first()->id != null) {

                $this->dados['headTitulo'] = "Adicionar Utilizador";
                $this->dados['headDescricao'] = "Area de Utilizadores";
                $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
                $this->dados['tipo'] = "edit";
                $this->dados['user'] = \DB::table('utilizador')->where('id', $id)->first();

                return view('backoffice/pages/users-edit', $this->dados);
            }
        }
        return redirect()->route('pageGestUser');
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

    public function validarFicheiro(Request $request, $path, $inputName)
    {

        if (filesize($request->file($inputName)) > 0) {

            $ficheiro = $request->file($inputName);
            $extensao = strtolower($ficheiro->getClientOriginalExtension());
            $extensaos = array("jpg", "JPG", "svg", "SVG", "jpeg", "JPEG", "png", "PNG");

            if (in_array($extensao, $extensaos)) {

                // verifica o tamanho do ficheiro | getSize() deveolve o tamanho em bytes
                if (filesize($request->file('uploadF')) <= 25000000) {

                    $photo = $ficheiro->getClientOriginalName();
                    $paths = $ficheiro->storeAs($path, $photo);

                    return "addFile";
                }
                return "Tamanho do Ficheiro Não Suportado " . $ficheiro->getSize() . " byte ! Max 25MB ";
            }

            return "Extensão do Ficheiro Não Suportado!";
        }

        return "empty";
    }


    public function addPost(Request $request)
    {
        // dados
        $nome = trim($request->nome);
        $email = trim($request->email);
        $userTipo = trim($request->userTipo);
        $photo = null;
        $token = \Str::random(12);

        if (empty($nome)) {
            return "Deve Indicar o Nome ! ";
        }
        if (empty($email)) {
            return "Deve Indicar o E-mail ! ";
        }
        if (empty($userTipo)) {
            return "Deve Indicar  Tipo de Utilizador ! ";
        }

        if (filesize($request->file('uploadF')) > 0) {

            // $validarFile = self::validarFicheiro($request, "app/public/", "uploadF");
            $pathF = "public_html/pontosystem/backoffice/img/";
            $validarFile = self::validarFicheiroV2($request, $pathF, "uploadF");

            if ($validarFile == "addFile") {
                $photo = $request->file('uploadF')->getClientOriginalName();
            } else {
                return  $validarFile;
            }
        }

        $user = \DB::table('utilizador')->where('email', $email)->first();
        if (empty($user->email)) {

            \DB::table('utilizador')->insert([
                'nome' => $nome,
                'email' => $email,
                'tipo' => $userTipo,
                'status' => "pendente",
                'pin' => '0000',
                'palavraPasse' => '0000',
                'token' =>  $token,
                'ultimoAcesso' => date('Y-m-d H:i:s'),
                'photo' => $photo,
            ]);

            self::sendEmailAtivarConta($email, $token);

            return "add";
        }

        return "E-mail Indicado já esta Registado!";
    }

    public function sendEmailAtivarConta($email, $token)
    {

        $detalhes = [
            'token' =>  $token,
            'email' => $email,
        ];

        Mail::to($email)->send(new MailTest($detalhes));
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

            // if (trim($request->holdMail) != $email) {

            //     $token = \Str::random(12);
            //     self::sendEmailAtivarConta($email, $token);
            // }

            return "update";
        }
        return "ID Invalido !";
    }

    public function delet($id)
    {
        if ($id) {
            $user = \DB::table('utilizador')->where('id', $id)->first();
            if (!empty($user->id)) {
                \DB::table('utilizador')->where('id', $id)->delete();
                // DELET FILE IMAGEs
                if ($user->photo != null) {
                    self::deletFile($user->photo, "backoffice/img");
                }
                return "delet";
            }
        }
        return "Não foi Indicado ID !";
    }

    public function deletFile($fileName, $path)
    {

        if (\Storage::exists($path . "/" . $fileName)) {

            \Storage::delete($path . "/" . $fileName);
        }
    }
}
