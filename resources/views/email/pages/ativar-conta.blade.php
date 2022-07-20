{{-- new version --}}
@extends('email/template/template')

@section('content')
    @include('email/includes/header')
    <!-- ICON -->
    <table style="padding-top:50px;" border="0" cellpadding="0" width="100%">
        <tr>
            <td align="center" width="100%">
                <img src="{{ asset('backoffice/img/restore.png') }}" alt="Restore" height="90">
            </td>
        </tr>
    </table>
    <!-- TEXTO -->
    <table style="padding-top:40px;" border="0" cellpadding="0" width="100%">
        <tr>
            <td align="center" width="100%" style="color:#58595b;font-size:14px;line-height:20px;">
                {!! trans('backoffice.ativeText') !!}
            </td>
        </tr>
    </table>
    <!-- BOTAO -->
    <table style="padding-top:40px;" border="0" cellpadding="0" width="100%">
        <tr>
            <td align="center" width="100%">
                <table style="font-size:14px;padding:8px 13px;color:#ffffff;background-color:#1266f1;">
                    <tr>
                        <td>
                            <a href="{{ route('pageAtivar',['token' => $detalhes['token']]) }}" target="_blank"
                                style="color:#ffffff;text-decoration:none;">{!! trans('backoffice.btnAtive') !!}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- DOESN'T WORK -->
    <table style="padding-top:40px;" border="0" cellpadding="0" width="100%">
        <tr>
            <td align="center" width="100%" style="color:#58595b;font-size:11px;line-height:15px;">
                {!! trans('backoffice.doesntWorkTx') !!} <a href="{{ route('pageAtivar', ['token' => $detalhes['token']]) }}"
                    style="text-decoration:none;color:#2fb385;"
                    target="_blank">{{ route('pageAtivar', ['token'=> $detalhes['token']]) }}</a>
            </td>
        </tr>
    </table>
@stop
