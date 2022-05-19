<div>
    <div class="mb-4">
        @can('create', App\Models\Respuestas::class)
        <button class="btn btn-primary" wire:click="newRespuestas">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.attach')
        </button>
        @endcan
    </div>

    <x-modal id="preguntas-all-respuestas-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="respuestas_id"
                            label="Respuestas"
                            wire:model="respuestas_id"
                        >
                            <option value="null" disabled>Please select the Respuestas</option>
                            @foreach($allRespuestasForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.checkbox
                            name="activo"
                            label="Activo"
                            wire:model="activo"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th class="text-left">
                        @lang('crud.preguntas_all_respuestas.inputs.respuestas_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.preguntas_all_respuestas.inputs.activo')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($preguntasAllRespuestas as $respuestas)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        {{ $respuestas->desRespuesta ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $respuestas->pivot->activo ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 70px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('delete-any', App\Models\Respuestas::class)
                            <button
                                class="btn btn-danger"
                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                wire:click="detach({{ $respuestas->id }})"
                            >
                                <i class="icon ion-md-trash"></i>
                                @lang('crud.common.detach')
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">{{ $preguntasAllRespuestas->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
