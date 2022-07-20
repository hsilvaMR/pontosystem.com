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
                        <a href="{{ route('pageGestUser') }}">
                            {{ trans('backoffice.menu1') }}
                        </a>
                    </li>
                    @switch($tipo)
                        @case('add')
                            <li class="breadcrumb-item cinza">
                                <a href="{{ route('pageAddUser') }}">
                                    {{ trans('backoffice.btnAdduser') }}
                                </a>
                            </li>
                        @break

                        @case('edit')
                            <li class="breadcrumb-item cinza">
                                <a href="{{ route('pageEddUser') }}">
                                    {{ trans('backoffice.btnEditar') }}
                                </a>
                            </li>
                        @break

                        @default
                            <li class="breadcrumb-item cinza">
                                <a href="{{ route('pageAddUser') }}">
                                    {{ trans('backoffice.menu1') }}
                                </a>
                            </li>
                    @endswitch
                </ol>
            </nav>
        </div>
        {{-- breadcrumb  end --}}
        <div class="container box-form-add-user">
            <div class="row  justify-content-center align-items-center">
                <form id="addUser" method="POST"  action="{{ route('adduser') }}" style="width: 100%">
                     {{ csrf_field() }}
                    {{-- photo --}}
                    <div class="row  justify-content-center align-items-center mb-3 mt-3">
                        <div class="col-3 text-center photoProfile">
                            {{-- Photo --}}
                            <div class="box-photo border border-1">
                                <img src="" class="d-none" alt="" id="user-photo" width="140px"
                                    height="140px">
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
                                <input type="text" id="frNome" class="form-control" name="nome" />
                                <label class="form-label" for="form2Example1">{{ trans('backoffice.colName') }}*</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="frMail" class="form-control" name="email" />
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
                                    <option value="Colaborador">{{ trans('backoffice.userTipo1') }}</option>
                                    <option value="Admin">{{ trans('backoffice.userTipo2') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                      {{-- info-mensagem --}}
                    <div class="form-outline  mx-auto  text-center col-6  mt-2 infomsg  text-center  mb-2 d-none">
                        <label id="errorMessg" class="form-label" for="form1Example1">{{ trans('utilizador.infoError1') }} </label>
                    </div>

                    {{-- btn add --}}
                    <div class="col-6  mx-auto  text-center">
                        <button type="submit" class="btn-add mt-3">
                            {{ trans('backoffice.btnAdd_user') }}
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
