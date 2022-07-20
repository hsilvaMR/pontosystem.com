<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Mail;
use App\Mail\MailRecover;
use Cookie;

class Login extends Controller
{
    private $dados = [];
    public function pageLoginUser()
    {
        $this->dados['headTitulo'] = "Login";
        $this->dados['headDescricao'] = "User";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        return view('utilizador/pages/login', $this->dados);
    }


    public function loginUser(Request $request)
    {
        $email = trim($request->frMail);
        $password = trim($request->frPass);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $user = \DB::table('utilizador')->where('email', $email)->where('tipo', "Colaborador")->first();
            if (!empty($user->email)) {

                if ($user->palavraPasse == $password && $user->status == "ativo" && $user->tipo == "Colaborador") {

                    $userDados = [
                        'id' => $user->id,
                        'nome' => $user->nome,
                        'email' => $user->email,
                        'tipo' => $user->tipo,
                        'status' => $user->status
                    ];
                    //  'atualizacao' => strtotime(date('Y-m-d H:i:s')),
                    $userDados = json_encode($userDados);
                    Cookie::queue(Cookie::make('user_cookie',  $userDados, 43200));
                    \DB::table('utilizador')->where('ultimoAcesso', $user->ultimoAcesso)->update(['ultimoAcesso' => date('Y-m-d H:i:s')]);
                    return "success";
                }
                return "Credenciais Inválido";
            }
            return "Credenciais Inválido";
        }
        return "E-mail Invalido !";
    }

    public function loginAdmin(Request $request)
    {

        $email = trim($request->frmail);
        $password = trim($request->frPassword);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $user = \DB::table('utilizador')->where('email', $email)->first();
            if (!empty($user->email)) {

                if ($user->palavraPasse == $password && $user->status == "ativo" && $user->tipo == "Admin") {

                    $userDados = [
                        'id' => $user->id,
                        'nome' => $user->nome,
                        'email' => $user->email,
                        'tipo' => $user->tipo,
                        'status' => $user->status,
                        'photo' => $user->photo
                    ];
                    //  'atualizacao' => strtotime(date('Y-m-d H:i:s')), user_cookie
                    $userDados = json_encode($userDados);
                    Cookie::queue(Cookie::make('admin_cookie',  $userDados, 43200));
                    \DB::table('utilizador')->where('ultimoAcesso', $user->ultimoAcesso)->update(['ultimoAcesso' => date('Y-m-d H:i:s')]);
                    return "success";
                }
                return "Credenciais Inválido";
            }
            return "Credenciais Inválido";
        }
        return "E-mail Invalido !";
    }

    public function logoutAdmin()
    {
    }

    public function pageLoginAdmin()
    {

        $this->dados['headTitulo'] = "admin";
        $this->dados['headDescricao'] = "Admin";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('backoffice/pages/login', $this->dados);
    }

    public function ativeCount($token)
    {
        if (!empty($token)) {

            $query = \DB::table('utilizador')->where('token', $token)->first();

            if (!empty($query->token)) {

                $this->dados['headTitulo'] = "Ativar Conta";
                $this->dados['headDescricao'] = "Ativar Conta";
                $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
                $this->dados['token'] = $token;
                $this->dados['tipo'] = $query->tipo;

                return view('utilizador/pages/validar-conta', $this->dados);
            }
        }
        return redirect()->route('homePage');
    }

    public function ativeCountPost(Request $request)
    {
        $password = trim($request->passV);
        $pin = trim($request->pinV);
        $token = trim($request->tokenV);

        if (empty($password) || empty($pin) || empty($token)) {

            return "Campos de Preenchimento  Obrigatório !";
        }
        $query = \DB::table('utilizador')->where('token', $token)->first();

        if (!empty($query->id)) {

            $consulta = \DB::table('utilizador')->orderBy('id', 'DESC')->get();
            foreach ($consulta as $item) {

                if ($item->pin == $pin) {
                    return "Pin Existe ! Indicar Outro.";
                }
            }
            \DB::table('utilizador')
                ->where('token', $token)
                ->update([
                    'status' => "ativo",
                    'token' => null,
                    'palavraPasse' => $password,
                    'pin' => $pin
                ]);
            return "ativo";
        }
        return "Token Invalido !";
    }

    public function sendEmailRecuperar($email, $token)
    {

        $detalhes = [
            'token' =>  $token,
            'email' => $email,
        ];

        Mail::to($email)->send(new MailRecover($detalhes));
    }
    public function senMailFormRecover(Request $request)
    {

        $email = trim($request->emailReset);
        $token = \Str::random(12);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $user = \DB::table('utilizador')->where('email', $email)->first();
            if (!empty($user->email)) {

                \DB::table('utilizador')
                    ->where('email', $email)
                    ->update([
                        'token' => $token,
                        'status' => "pendente",
                        'palavraPasse' => "hjdkldkll",
                ]);
               
                self::sendEmailRecuperar($email, $token);
                return "enviado";
            }
            return "Email não Existe na Base de Dados!";
        }
        return "Email Invalido !";
    }

    public function recuperarPage($token)
    {
        if (!empty($token)) {

            $query = \DB::table('utilizador')->where('token', $token)->first();

            if (!empty($query->token)) {

                $this->dados['headTitulo'] = "Ativar Conta";
                $this->dados['headDescricao'] = "Ativar Conta";
                $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
                $this->dados['token'] = $token;
                $this->dados['tipo'] = $query->tipo;

                return view('utilizador/pages/reset-password', $this->dados);
            }
        }
        return redirect()->route('homePage');
    }

    public function recuperarPassword(Request $request)
    {

        $password = trim($request->frRecover);
        $token = trim($request->tokenR);


        if (empty($password)  || empty($token)) {

            return "Campos de Preenchimento  Obrigatório !";
        }

        $query = \DB::table('utilizador')->where('token', $token)->first();

        if (!empty($query->token)) {
           
            \DB::table('utilizador')
            ->where('token', $token)
            ->update([
                'status' => "ativo",
                'token' => null,
                'palavraPasse' => $password,
            ]);
            return "ativo";
        }
        return "Token Invalido !";
    }
}
