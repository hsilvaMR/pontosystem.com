{{-- Modal delete --}}
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modalD" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalD">{{ trans('backoffice.modaDel1') }} </h5>
                <button type="button" class="btn-close" onclick="removID('modal-delete')" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">{{ trans('backoffice.modaDel2') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="dialog_sim" class="btn btn-danger"
                    data-bs-dismiss="modal">{{ trans('backoffice.modaDel3') }}</button>
                <button type="button" onclick="removID('modal-delete')"
                    class="btn btn-primary">{{ trans('backoffice.modaDel4') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- consulta de hora --}}
{{-- consulta de hora --}}
{{-- consulta de hora --}}
<div class="modal fade" tabindex="-1" id="modal-consulta" aria-hidden="true" data-mdb-backdrop="static"
    aria-labelledby="staticBackdropLabel" data-mdb-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center">{{ trans('backoffice.menu3') }} </h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- formulario --}}
                @if (isset($modulo) && $modulo == 'CL')
                    <form action="{{ route('pageCsCL') }}" id="consultaTime" method="POST" style="width: 100%;">
                    @else
                        <form action="{{ route('pageConsulta') }}" id="consultaTime" method="POST"
                            style="width: 100%;">
                @endif
                <form action="{{ route('pageConsulta') }}" id="consultaTime" method="POST" style="width: 100%;">
                    {{ csrf_field() }}
                    <div class="box-item container">
                        {{-- row form --}}
                        <div class="row mt-3 justify-content-center">

                            {{-- ID --}}
                            <div class="col-3">
                                <label class="form-label" for="diaID">{{ trans('backoffice.IDf') }} * </label>
                                <div class="form-outline mb-4">
                                    <input type="text" maxlength="12" onkeypress='validate(event)' name="idF"
                                        id="idF" class="form-control"
                                        @if (isset($modulo) && $modulo == 'CL')

                                        value="{{  json_decode(\Cookie::get('user_cookie'))->id }}"
                                        readonly
                                        @else 
                                        value=""
                                        @endif  
                                    />
                                </div>
                            </div>
                            {{-- MES --}}
                            <div class="col-4">
                                <label class="form-label" for="mesID">{{ trans('backoffice.month') }} * </label>
                                <div class="form-outline mb-4">
                                    <select class="form-select" aria-label="Default select example" name="selecMonth"
                                        id="selecMonth">
                                        <option disabled value="" selected></option>
                                        <option value="Janeiro">Janeiro</option>
                                        <option value="Feveiro">Feveiro</option>
                                        <option value="Março">Março</option>
                                        <option value="Abril">Abril</option>
                                        <option value="Maio">Maio</option>
                                        <option value="Junho">Junho</option>
                                        <option value="Julho">Julho</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Setembro">Setembro</option>
                                        <option value="Outubro">Outubro</option>
                                        <option value="Novembro">Novembro</option>
                                        <option value="Dezembro">Dezembro</option>
                                    </select>
                                </div>
                            </div>
                            {{-- ANO --}}
                            <div class="col-2">
                                <label class="form-label" for="anoID">{{ trans('backoffice.year') }} * </label>
                                <div class="form-outline mb-4">
                                    <select class="form-select" aria-label="Default select example" name="selecAno"
                                        id="selecAno">
                                        <option disabled value="" selected></option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>

                            {{-- end  formulario --}}
                            <div class="modal-footer justify-content-center ">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i>
                                    {{ trans('backoffice.btnCons') }}
                                </button>
                            </div>

                        </div>
                        {{-- end row  form --}}
                    </div>

                </form>

                {{-- row resultado da consulta --}}
                <div class="box-result-consulta mt-2 d-none">

                    {{-- nome --}}
                    <div class="row justify-content-center">
                        <div class="col-8">
                            {{-- NAME --}}
                            <div class="form-outline mb-4">
                                <label class="form-label" for="nameId">{{ trans('utilizador.frname') }} </label>
                                <input type="text" id="nomeF" name="nomeF" readonly class="form-control" />
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- total de HORAS --}}
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="form-outline mb-4">
                                <label class="form-label" id="infoTotal"for="lblTotal">
                                    Total de Horas Trabalhado Em
                                    <b> <span id="dataStrong"></span></b>
                                </label>
                                <input type="text" id="lblTotal" name="lblTotal" readonly
                                    class="form-control" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
