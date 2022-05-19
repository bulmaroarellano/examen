@php $editing = isset($examenes) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 d-none">
        <x-inputs.text
            name="idUsuario"
            label="Id Usuario"
            value="{{ old('idUsuario', ($editing ? $examenes->idUsuario :  Auth::user()->id)) }}"
            maxlength="255"
            placeholder="Id Usuario"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="numPreguntas"
            label="Num Preguntas"
            value="{{ old('numPreguntas', ($editing ? $examenes->numPreguntas : '')) }}"
            max="255"
            placeholder="Num Preguntas"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
