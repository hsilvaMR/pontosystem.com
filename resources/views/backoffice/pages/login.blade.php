@extends('backoffice/template/login')

@section('content')
    <div class="container modulo-login">
        <div class="row justify-content-center">
            <div class="col-5">
                {{-- logo --}}
                <a href="/" class=" mb-3">
                    <img class="login-logo" src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png">
                </a>
                <form id="loginFormAdmin" method="POST" action="{{ route('login2') }}">
                     {{ csrf_field() }}
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="frMail" class="form-control" name="frmail" />
                        <label class="form-label" for="frMail"> {{ trans('utilizador.frEmail') }}</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="frPassword" class="form-control"  name="frPassword"/>
                        <label class="form-label" for="frPassword">{{ trans('utilizador.frPassword') }}</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">

                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="checkRemenber" id="checkRemenber" />
                                <label class="form-check-label" for="checkRemenber">{{ trans('utilizador.frRemenber') }}</label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a id="recoverPassword">{{ trans('utilizador.btnRecover') }}</a>
                        </div>
                    </div>

                    {{-- info-mensagem --}}
                    <div class="form-outline mt-2 infomsg  text-center text-danger mb-2 border-b d-none">
                        <label id="errorMessg" class="form-label" for="form1Example1">{{ trans('utilizador.infoError1') }} </label>
                    </div>
                    {{-- btn login --}}
                    <button type="submit" class="btn btn-primary btn-block mb-4">{{ trans('utilizador.btnEntrar') }}</button>
                </form>
            </div>
        </div>
    </div>

    {{-- reset passowrd box --}}
    <div class="modulo-reset-password d-none mt-5">

        <div class="row justify-content-center">
            <div class="col-5">

                {{-- logo --}}
                <a href="/">
                    <img class="login-logo" src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png">
                </a>
               <form id="frReset" method="POST" action="{{ route('pageRVFR') }}">
                 {{ csrf_field() }}
                    <!-- email input -->
                    <div class="mb-3">
                        <label for="emailReset" class="form-label">{{ trans('utilizador.frEmail') }}</label>
                        <input type="email" class="form-control" id="emailReset" name="emailReset">
                    </div>

                    <div class="col text-center">
                        <!-- Simple link -->
                        <a id="moduloLogin">{{ trans('utilizador.btnDOlogin') }}</a>
                    </div>
                    {{-- info-mensagem --}}
                    <div class="form-outline mt-2 infomsg  text-center text-danger mb-2 border-b d-none">
                        <label class="form-label" id="infomsgAtivar" for="msgElement">{{ trans('utilizador.infoError2') }}</label>
                    </div>
                    {{-- btn login --}}
                    <button type="submit" class="btn btn-primary btn-block mb-4">{{ trans('utilizador.btnSend') }}</button>
                </form>
            </div>
        </div>

    </div>
@endsection
