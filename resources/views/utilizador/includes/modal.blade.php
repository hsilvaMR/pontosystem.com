{{-- abrir o Ponto --}}
{{-- abrir o Ponto --}}
<div class="modal fade" tabindex="-1" id="modal-open-point" aria-hidden="true" data-mdb-backdrop="static"
    aria-labelledby="staticBackdropLabel" data-mdb-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center">Abrir Ponto</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('checkOpen') }}" id="openForm" method="POST">
                    {{-- formulario --}}
                    {{ csrf_field() }}
                    <div class="box-item container">
                        <div class="row">
                            <div class="col-8">
                                {{-- NAME --}}
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nameId">{{ trans('utilizador.frname') }} </label>
                                    <input type="text" id="nameId" name="nameId" readonly class="form-control" />
                                    </label>
                                </div>
                                {{-- ID --}}
                                <label class="form-label" for="idFuncionario">{{ trans('utilizador.frid') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text"  name="idF" id="idFuncionario" readonly class="form-control" />
                                </div>
                            </div>
                            <div class="col-4 border border-2">

                            </div>
                        </div>
                        {{-- time --}}
                        <div class="row mt-3">
                            <div class="col-2">
                                {{-- hora --}}
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="horaId">{{ trans('utilizador.frhORA') }} </label>
                                    <input type="text" name="horaINIT" id="horaId" readonly class="form-control"
                                        value="15:35:45" />
                                    {{-- <label class="form-label" for="horaId">{{ trans('utilizador.frhORA') }} --}}
                                    </label>
                                </div>
                            </div>
                            {{-- dia --}}
                            <div class="col-2">
                                <label class="form-label" for="diaID">{{ trans('utilizador.dia') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="diaID" id="diaID" readonly class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-2">
                                {{-- MES --}}
                                <label class="form-label" for="mesID">{{ trans('utilizador.frmes') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="mesID" id="mesID" readonly class="form-control" value="" />
                                </div>
                            </div>

                            <div class="col-2">
                                {{-- ANO --}}
                                <label class="form-label" for="anoID">{{ trans('utilizador.frAno') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="anoID" id="anoID" readonly class="form-control" value="" />
                                    {{-- <label class="form-label" for="anoID">{{ trans('utilizador.frAno') }} </label> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end  formulario --}}
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Abrir Ponto</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- fechar Ponto --}}
{{-- fechar Ponto --}}
{{-- fechar Ponto --}}
<div class="modal fade" tabindex="-1" id="modal-close-point" aria-hidden="true" data-mdb-backdrop="static"
    aria-labelledby="staticBackdropLabel" data-mdb-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center">Fechar Ponto</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('checkClose') }}" id="closeForm" method="POST">
                    {{-- formulario --}}
                    {{ csrf_field() }}
                    <div class="box-item container">
                        <div class="row">
                            <div class="col-8">
                                {{-- NAME --}}
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nameId">{{ trans('utilizador.frname') }} </label>
                                    <input type="text" id="nameIdc" name="nameIdC" readonly class="form-control" />
                                    {{-- </label> --}}
                                </div>
                                {{-- ID --}}
                                <label class="form-label" for="idFuncionario">{{ trans('utilizador.frid') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text"  name="idFc" id="idFuncionarioC" readonly class="form-control" />
                                </div>
                            </div>
                            <div class="col-4 border border-2">

                            </div>
                        </div>
                        {{-- time --}}
                        <div class="row mt-3">
                            <div class="col-2">
                                {{-- hora --}}
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="horaId">{{ trans('utilizador.frhORA1') }} </label>
                                    <input type="text" name="horaFIM" id="horaIdC" readonly class="form-control"
                                        value="15:35:45" />
                                    {{-- <label class="form-label" for="horaId">{{ trans('utilizador.frhORA') }} --}}
                                    </label>
                                </div>
                            </div>
                            {{-- dia --}}
                            <div class="col-2">
                                <label class="form-label" for="diaID">{{ trans('utilizador.dia') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="diaIDC" id="diaIDC" readonly class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-2">
                                {{-- MES --}}
                                <label class="form-label" for="mesID">{{ trans('utilizador.frmes') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="mesIDC" id="mesIDC" readonly class="form-control" value="" />
                                </div>
                            </div>

                            <div class="col-2">
                                {{-- ANO --}}
                                <label class="form-label" for="anoID">{{ trans('utilizador.frAno') }} </label>
                                <div class="form-outline mb-4">
                                    <input type="text" name="anoIDC" id="anoIDC" readonly class="form-control" value="" />
                                    {{-- <label class="form-label" for="anoID">{{ trans('utilizador.frAno') }} </label> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end  formulario --}}
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Fechar Ponto</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- mensagem success --}}
{{-- mensagem success --}}
{{-- mensagem success --}}
<div class="modal fade" tabindex="-1" id="modal-msg" aria-hidden="true" data-mdb-backdrop="static"
    aria-labelledby="staticBackdropLabel" data-mdb-keyboard="false">
    <div class="modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
