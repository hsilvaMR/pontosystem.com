@extends('backoffice/template/backoffice')

@section('content')
    <div class="container mt-5 box-gest-user">

        {{-- breadcrumb --}}
        <div class="border-bottom">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pageDashboard') }}">
                            {{ trans('backoffice.mainArea') }}
                        </a>
                    </li>
                    @if ($tipo != 'gestao')
                        <li class="breadcrumb-item cinza">
                            <a href="{{ route('pageGestUser') }}">
                                {{ trans('backoffice.menu1') }}
                            </a>
                        </li>
                    @endif

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

        <div class="btn-add" id="btn-add-user">
            {{ trans('backoffice.btnAdduser') }}
        </div>

        {{-- <div class="table-modulo"> --}}

        <table class="table  table-striped table-bordered" id="tblUsers" style="width:100%">
            <thead class="table-primary mt-1">
                <tr>
                    <th scope="col"># {{ trans('backoffice.colID') }} </th>
                    <th scope="col">{{ trans('backoffice.colName') }}</th>
                    <th scope="col">{{ trans('backoffice.colEmail') }}</th>
                    <th scope="col">{{ trans('backoffice.tipo') }}</th>
                    <th scope="col">{{ trans('backoffice.colStatus') }}</th>
                    <th scope="col">{{ trans('backoffice.colAction') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $val)
                    <tr id="linha_{{ $val['id'] }}">
                        <td>{{ $val['id'] }}</td>
                        <td>{!! $val['nome'] !!}</td>
                        <td>{{ $val['email'] }}</td>
                        <td>{{ $val['tipo'] }}</td>
                        <td>{{ $val['status'] }}</td>
                        {{-- action --}}
                        <td class="text-center td-action">
                            {{-- edit --}}
                            <a href="{{ route('pageEddUser', $val['id']) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>&ensp;
                            {{-- delet --}}
                            <span onclick="saveId('{{ $val['id'] }}','modal-delete')">
                                <i class="far fa-trash-alt"></i>&nbsp;
                            </span>&ensp;
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('backoffice/includes/modal')
@endsection

@section('script')
    <script>
        $('#tblUsers').dataTable({
            aoColumnDefs: [{
                "bSortable": false,
                "aTargets": [5],
            }],
            scrollY: '300px',
            scrollCollapse: true,
        })
    </script>
@endsection
