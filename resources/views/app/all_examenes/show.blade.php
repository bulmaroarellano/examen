@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-examenes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_examenes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_examenes.inputs.idUsuario')</h5>
                    <span>{{ $examenes->idUsuario ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_examenes.inputs.numPreguntas')</h5>
                    <span>{{ $examenes->numPreguntas ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-examenes.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Examenes::class)
                <a
                    href="{{ route('all-examenes.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Preguntas::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">All Preguntas</h4>

            <livewire:examenes-all-preguntas-detail :examenes="$examenes" />
        </div>
    </div>
    @endcan
</div>
@endsection
