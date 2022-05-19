@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-respuestas.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_respuestas.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('all-respuestas.update', $respuestas) }}"
                class="mt-4"
            >
                @include('app.all_respuestas.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('all-respuestas.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('all-respuestas.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
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
