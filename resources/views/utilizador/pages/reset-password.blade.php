@extends('utilizador/template/login')

@section('content')
    <div class="container modulo-login">
        <div class="row justify-content-center">
            <div class="col-5">

                {{-- logo --}}
                <a href="/">
                    <img class="login-logo" src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png">
                </a>
               <form id="frResetPassword" method="POST" action="{{ route('pageRV') }}">
                     {{ csrf_field() }}
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="hidden" name="tokenR" value="{{$token}}"/>
                         <input type="hidden" name="tipoR" id="tipoV" value="{{$tipo}}"/>
                        <input type="password"  maxlength="12" id="frRecover" class="form-control" name="frRecover" />
                        <label class="form-label" for="frRecover">{{ trans('utilizador.frPassword1') }}</label>
                    </div>

                    {{-- info-mensagem --}}
                    <div class="form-outline mt-2 infomsg  text-center text-danger mb-2 border-b d-none">
                        <label class="form-label" id="infoPass">{{ trans('utilizador.infoError3') }} </label>
                    </div>
                    {{-- btn login --}}
                    <button type="submit" class="btn btn-primary btn-block mb-4">{{ trans('utilizador.btnRecover3') }}</button>

                </form>
            </div>
        </div>

    </div>

 
@endsection
