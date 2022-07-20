@extends('backoffice/template/backoffice')

@section('content')
    <div class="container mt-5 box-registo-hora">

        {{-- breadcrumb --}}
        <div class="border-bottom">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pageDashboard') }}">
                            {{ trans('backoffice.mainArea') }}
                        </a>
                    </li>
                    @if ($tipo == 'Ponto')
                        <li class="breadcrumb-item cinza">
                            <a href="{{ route('pageGestUser') }}">
                                {{ trans('backoffice.menu2') }}
                            </a>
                        </li>
                    @endif

                </ol>
            </nav>
        </div>
        {{-- breadcrumb  end --}}
        {{-- <div class="table-modulo"> --}}
        <table class="table  table-striped table-bordered" id="tblPontos" style="width:100%">
            <thead class="table-primary mt-1">
                <tr>
                    <th scope="col"># {{ trans('backoffice.colID') }} </th>
                    <th scope="col">{{ trans('backoffice.colName') }}</th>
                    <th scope="col">{{ trans('backoffice.init') }}</th>
                    <th scope="col">{{ trans('backoffice.end') }}</th>
                    <th scope="col">{{ trans('backoffice.total') }}</th>
                    <th scope="col">{{ trans('backoffice.dateP') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pontos as $val)
                    <tr id="linha_{{ $val['id'] }}">
                        <td>{{ $val['id'] }}</td>
                        <td>{!! $val['nome'] !!}</td>
                        <td>{{ $val['inicio'] }}</td>
                        <td>{{ $val['fim'] }}</td>
                        <td>{{ $val['total'] }}</td>
                        <td>{{ $val['data'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div> --}}

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#tblPontos').DataTable({
                scrollY: '260px',
                scrollCollapse: true,
            })

        })
    </script>
@endsection
