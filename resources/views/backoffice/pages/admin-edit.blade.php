@extends('backoffice/template/backoffice')
@section('content')
    <div class="container mt-4 mb-5 box-add-user">
        {{-- breadcrumb --}}
        <div class="border-bottom">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pageDashboard') }}">
                            {{ trans('backoffice.mainArea') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item ">
                        <a href="{{ route('pageShowAdmin') }}">
                            {{ trans('backoffice.menu4') }}
                        </a>
                    </li>
                    @switch($tipo)
                        @case('show')
                            <li class="breadcrumb-item cinza">
                                <a href="{{ route('pageShowAdmin') }}">
                                    {{ trans('backoffice.menu4') }}
                                </a>
                            </li>
                        @break

                        @case('editM')
                            <li class="breadcrumb-item cinza">
                                <a href="{{ route('pageEditAdmin', $user->id) }}">
                                    {{ trans('backoffice.submenu5') }}
                                </a>
                            </li>
                        @break
                    @endswitch
                </ol>
            </nav>
        </div>
        {{-- breadcrumb  end --}}

        <div class="container box-form-add-user">
            <div class="row  justify-content-center align-items-center">
                <form id="editUser" method="POST" action="{{ route('editUser') }}" style="width: 100%">
                    {{ csrf_field() }}
                    {{-- photo --}}
                    <div class="row  justify-content-center align-items-center mb-3 mt-3">
                        <div class="col-3 text-center photoProfile">
                            {{-- Photo --}}
                            <div class="box-photo border border-1">

                                <img src="@if ($user->photo != null) {{ asset('backoffice/img/' . $user->photo) }} @endif"
                                    class="d-none" alt="" id="user-photo" width="140px" height="140px">
                            </div>

                            {{-- btn upload | delet --}}
                            <div class="mb-2">
                                {{-- btn upload --}}
                                <label class="lb-40 bt-azul float-right me-4" for="uploadF">
                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                </label>
                                <input id="uploadF" name="uploadF" type="file" accept="image/*"
                                    onchange="uploadFile(this,'box-photo');">
                                {{-- btn delete --}}
                                <label class="lb-40 bt-azul float-right" id="cleanFile">
                                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- form items --}}
                    <div class=" row  justify-content-center align-items-center ">
                        <div class="col-6 col-sm-6 col-md-6 col-xxl-6 col-xl-6">
                            <!-- Nome input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="frNome"
                                    value="@if (isset($user->nome)) {{ $user->nome }} @endif"class="form-control"
                                    name="nome" />
                                <input type="hidden" name="idEdit" value="{{ $user->id }}" />
                                <input type="hidden" name="holdMail" value="{{ $user->email }}" />
                                <label class="form-label" for="form2Example1">{{ trans('backoffice.colName') }}*</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="frMail"
                                    value="@if (isset($user->email)) {{ $user->email }} @endif"
                                    class="form-control" name="email" />
                                <label class="form-label" for="form2Example1">
                                    {{ trans('backoffice.colEmail') }}*</label>
                            </div>
                            <!-- tipo input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example1">
                                    {{ trans('backoffice.colTipo') }}*</label>
                                <select class="form-select" aria-label="Default select example" name="userTipo"
                                    id="userTipo">
                                    <option disabled value="" selected></option>
                                    <option value="Colaborador" @if (isset($user->tipo) && $user->tipo == 'Colaborador') selected @endif>
                                        {{ trans('backoffice.userTipo1') }}</option>
                                    <option value="Admin" @if (isset($user->tipo) && $user->tipo == 'Admin') selected @endif>
                                        {{ trans('backoffice.userTipo2') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- info-mensagem --}}
                    <div class="form-outline  mx-auto  text-center col-6  mt-2 infomsg  text-center  mb-2 d-none">
                        <label id="errorMessg" class="form-label"
                            for="form1Example1">{{ trans('utilizador.infoError1') }} </label>
                    </div>

                    {{-- btn add --}}
                    <div class="col-6  mx-auto  text-center">
                        <button type="submit" class="btn-add mt-3">
                            {{ trans('backoffice.btnUpdate') }}
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#user-photo').removeClass("d-none")
        })
    </script>
@endsection
