@extends('backoffice/template/backoffice')

@section('content')
    <div class="dashboard-content container mt-5">
        {{-- modulos --}}
        <div class="d-flex justify-content-center " style="height:80% !important;">

            {{-- gestão de utilizador modulo --}}
            <div class="modulo-user modulo me-3">

                <div class="modulo-body" >
                    <h1 class="ms-2">
                        {{$num1}}
                        <i class="fa-solid fa-users fa-2x me-1 modulo-icone"></i>
                    </h1>
                </div>

                <div class="modulo-footer" id="gestUser">
                    <span >  {{ trans('backoffice.menu1') }} </span>
                    <i class="fa-solid fa-arrow-right fa-2x modulo-icone"></i>
                </div>

            </div>
            {{-- register ponto mudulo --}}
            <div class="ponto-modulo modulo me-3">
                <div class="modulo-body">
                   <h1 class="ms-2">
                         {{$num2}}
                        <i class="fa-solid fa-clock fa-2x me-1 modulo-icone"></i>
                    </h1>
                </div>
                <div class="modulo-footer" id="registerTime">
                    <span>  {{ trans('backoffice.menu2') }} </span>
                    <i class="fa-solid fa-arrow-right fa-2x modulo-icone"></i>
                </div>

            </div>
            {{-- consultas --}}
            <div class="consulta modulo">
                <div class="modulo-body">
                    <h1>
                         <i class="fa-solid fa-user-clock fa-2x modulo-icone"></i>
                    </h1>
                </div>
                <div class="modulo-footer" id="consultaH" >
                    <span>  {{ trans('backoffice.menu3') }} </span>
                    <i class="fa-solid fa-arrow-right fa-2x modulo-icone"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('backoffice/includes/modal') --}}
@endsection
