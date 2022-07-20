<div class=" container box-open-point border border-2">
    {{-- <form id="pinCheck" method="POST" action="{{ route('chekPin') }}"> --}}
    <form id="formPinCheckOpen" method="POST" action="{{ route('chekPin') }}">
          {{ csrf_field() }}
        <!-- Email input -->
        <div class="form-outline mb-4">
             <input type="hidden" id="idTipo" name="custId" value="{{$tipo}}">
            <input type="text" id="pinOpen"  maxlength="4"  onkeypress='validate(event)' name="pin" class="form-control" />
            <label class="form-label" for="pinOpen">Inserir Pin </label>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block ">Validar</button>
        {{-- info-mensagem --}}
        <div class="form-outline mt-2 infomsg d-none">
            <label class="form-label">Inserir Pin</label>
        </div>
    </form>
</div>
