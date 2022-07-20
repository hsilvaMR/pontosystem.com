@extends('utilizador/template/utilizador')

@section('content')
    <div class="homePage container mt-5">
     {{--  abrir Ponto  --}}
        @if ($tipo == 'open')
             @include('utilizador/includes/boxOpen')
        @else
        {{-- fechar Ponto --}}
             @include('utilizador/includes/boxClose')
        @endif
    </div>
    @include('utilizador/includes/modal')
@endsection
