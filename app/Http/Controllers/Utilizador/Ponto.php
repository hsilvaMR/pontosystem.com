<?php

namespace App\Http\Controllers\Utilizador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class Ponto extends Controller
{
    private $dados = [];
    public function index()
    {
        $this->dados['headTitulo'] = "Tela Ponto";
        $this->dados['headDescricao'] = "Ponto";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('utilizador/pages/ponto', $this->dados);
    }

    public function abrirPage()
    {

        $this->dados['headTitulo'] = "Abrir Ponto";
        $this->dados['headDescricao'] = "Ponto-Abrir";
        $this->dados['tipo'] = "open";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('utilizador/pages/ponto', $this->dados);
    }

    public function fecharPage()
    {
        $this->dados['headTitulo'] = "Fechar Ponto";
        $this->dados['headDescricao'] = "Ponto-Fechar";
        $this->dados['tipo'] = "close";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');

        return view('utilizador/pages/ponto', $this->dados);
    }

    public function abrir(Request $request)
    {
        // dados
        $nome = trim($request->nameId);
        $idF = trim($request->idF);
        $horaINIT = trim($request->horaINIT);
        $diaID = trim($request->diaID);
        $mesID = trim($request->mesID);
        $anoID = trim($request->anoID);
        $today = date('Y-m-d');

        if (empty($nome)) {
            return "Deve Indicar o Nome ! ";
        }
        if (empty($diaID)) {
            return "Dia Invalido ! ";
        }
        if (empty($horaINIT)) {
            return "hora Invalido  ! ";
        }
        if (empty($mesID)) {
            return "MES Invalido  ! ";
        }
        if (empty($anoID)) {
            return "Ano Invalido  ! ";
        }

        $ponto = \DB::table('ponto')->where('data', $today)->orderBy('id', 'DESC')->first();

        if (!empty($ponto->id)) {

            // verificar data em aberto !
            if ($ponto->hora_inicio != null && $ponto->hora_fim == null  && $ponto->total==null ) {

                return "Deve Primeiro Encerrar O Ponto que se encontra aberto !";
            }
        }

        \DB::table('ponto')->insert([
            'nome' => $nome,
            'hora_inicio' => $horaINIT,
            'dia' => $diaID,
            'mes' => $mesID,
            'ano' => $anoID,
            'id_utilizador' => $idF,
            'data' => date('Y-m-d'),
        ]);

        return "aberto";
    }

    public function fechar(Request $request)
    {
        // dados
        $nome = trim($request->nameIdC);
        $idF = trim($request->idFc);
        $horaFim = trim($request->horaFIM);
        $diaID = trim($request->diaIDC);
        $mesID = trim($request->mesIDC);
        $anoID = trim($request->anoIDC);
        $today = date('Y-m-d');


        if (empty($nome)) {
            return "Deve Indicar o Nome ! ";
        }
        if (empty($diaID)) {
            return "Dia Invalido ! ";
        }
        if (empty($horaFim)) {
            return "hora Invalido  ! ";
        }
        if (empty($mesID)) {
            return "MES Invalido  ! ";
        }
        if (empty($anoID)) {
            return "Ano Invalido  ! ";
        }

        $ponto = \DB::table('ponto')->where('data', $today)->orderBy('id', 'DESC')->first();

        if (!empty($ponto->id) &&  !empty($ponto->hora_inicio)) {


            if (!empty($ponto->hora_fim) && !empty($ponto->total)) {

                return "O Ponto já se Encontra Fechado !";
            }


            $thoras = explode(":", date("H:i:s", strtotime($horaFim) - strtotime($ponto->hora_inicio)));
            $strTime =  ($thoras[0] + ($thoras[1] / 60) +  ($thoras[2] / 3600));
            $totalH  = number_format((float)($strTime), 2, '.', '');
            \DB::table('ponto')
                ->where('hora_inicio', $ponto->hora_inicio)
                ->update([
                    'hora_fim' => $horaFim,
                    'total' => $totalH,
                    'data' => date('Y-m-d'),
                ]);

            return "fechado";
        }

        return "Para Realizar esta Operação Deverá Primeiro Abrir Ponto!";
    }

    public function validarPin(Request $request)
    {

        if (!empty(trim($request->pin))) {

            $pin = trim($request->pin);

            $user = \DB::table('utilizador')->where('pin', $pin)->first();

            if (!empty($user->id)) {


                if ($user->status == "bloqueado" || $user->status == "pendente") {
                    return "Não tem permissão para aceder está funcionalidade !";
                }

                if ($user->pin == $pin) {

                    $userDadoPin = [
                        'id' => $user->id,
                        'nome' => $user->nome,
                        'photo' => $user->photo,
                        'sucess' => "valido"
                    ];

                    // $userDadoPin = json_encode($userDadoPin, true);
                    // Cookie::queue(Cookie::make('pinCokie', $userDadoPin, 1200));
                    return json_encode($userDadoPin, true);
                }
                return "invalid";
            }
            return "invalid";
        }
        return "empty";
    }
}
