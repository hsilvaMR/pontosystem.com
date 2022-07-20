@extends('utilizador/template/login')

@section('content')
    <div class="container modulo-login">
        <div class="row justify-content-center">
            <div class="col-5">

                {{-- logo --}}
                <a href="/">
                    <img class="login-logo" src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png">
                </a>
                  <form id="frValidarConta" method="POST" action="{{ route('pageVAC') }}">
                     {{ csrf_field() }}
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="hidden" name="tokenV" value="{{$token}}"/>
                         <input type="hidden" name="tipo" value="{{$tipo}}"/>
                        <input type="password" maxlength="12" id="passwordV" name="passV" class="form-control" />
                        <label class="form-label" for="passwordV">{{ trans('utilizador.frPassword') }}*</label>
                    </div>
                    <!-- pin input -->
                    <div class="form-outline mb-4">
                        <input type="text" maxlength="4" name="pinV" id="pinV"  onkeypress='validate(event)' class="form-control" />
                        <label class="form-label" for="pinV">{{ trans('utilizador.frPin') }}*</label>
                    </div>

                    {{-- info-mensagem --}}
                    <div class="form-outline mt-2 infomsg  text-center text-danger mb-2 border-b d-none">
                        <label class="form-label" id="infomsgAtivar" ></label>
                    </div>
                    {{-- btn login --}}
                    <button type="submit" class="btn btn-primary btn-block mb-4">{{ trans('utilizador.btnAtivar') }}</button>
                </form>
            </div>
        </div>

    </div>
@endsection
