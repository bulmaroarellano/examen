@php $editing = isset($respuestas) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="desRespuesta"
            label="Des Respuesta"
            value="{{ old('desRespuesta', ($editing ? $respuestas->desRespuesta : '')) }}"
            maxlength="255"
            placeholder="Des Respuesta"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="correcta"
            label="Correcta"
            :checked="old('correcta', ($editing ? $respuestas->correcta : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="activo"
            label="Activo"
            :checked="old('activo', ($editing ? $respuestas->activo : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
