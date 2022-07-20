<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ponto extends Controller
{
    public function index()
    {

        $this->dados['headTitulo'] = "Gest-Horas";
        $this->dados['headDescricao'] = "Backpffice";
        $this->dados['headFoto'] = asset('/img/imgs/fb-mredis.jpg');
        $this->dados['tipo'] = "Ponto";

        $pontos = \DB::table('ponto')->orderBy('id', 'DESC')->get();
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

        return view('backoffice/pages/pontos', $this->dados);
    }

    //  Consulta de Hora
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

        if ($soma>0 ) {
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
