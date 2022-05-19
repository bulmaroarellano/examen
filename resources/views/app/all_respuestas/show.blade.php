@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-respuestas.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_respuestas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_respuestas.inputs.desRespuesta')</h5>
                    <span>{{ $respuestas->desRespuesta ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_respuestas.inputs.correcta')</h5>
                    <span>{{ $respuestas->correcta ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_respuestas.inputs.activo')</h5>
                    <span>{{ $respuestas->activo ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-respuestas.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Respuestas::class)
                <a
                    href="{{ route('all-respuestas.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\examenes_preguntas::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">All Preguntas</h4>

            <livewire:respuestas-all-preguntas-detail
                :respuestas="$respuestas"
            />
        </div>
    </div>
    @endcan
</div>
@endsection
