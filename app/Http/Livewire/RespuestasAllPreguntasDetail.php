<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Preguntas;
use App\Models\Respuestas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RespuestasAllPreguntasDetail extends Component
{
    use AuthorizesRequests;

    public Respuestas $respuestas;
    public Preguntas $preguntas;
    public $allPreguntasForSelect = [];
    public $preguntas_id = null;
    public $activo;

    public $showingModal = false;
    public $modalTitle = 'New Preguntas';

    protected $rules = [
        'preguntas_id' => ['required', 'exists:tbl_preguntas,id'],
        'activo' => ['required', 'boolean'],
    ];

    public function mount(Respuestas $respuestas)
    {
        $this->respuestas = $respuestas;
        $this->allPreguntasForSelect = Preguntas::pluck('desPregunta', 'id');
        $this->resetPreguntasData();
    }

    public function resetPreguntasData()
    {
        $this->preguntas = new Preguntas();

        $this->preguntas_id = null;
        $this->activo = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPreguntas()
    {
        $this->modalTitle = trans('crud.respuestas_all_preguntas.new_title');
        $this->resetPreguntasData();

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        $this->authorize('create', Preguntas::class);

        $this->respuestas->allPreguntas()->attach($this->preguntas_id, [
            'activo' => $this->activo,
        ]);

        $this->hideModal();
    }

    public function detach($preguntas)
    {
        $this->authorize('delete-any', Preguntas::class);

        $this->respuestas->allPreguntas()->detach($preguntas);

        $this->resetPreguntasData();
    }

    public function render()
    {
        return view('livewire.respuestas-all-preguntas-detail', [
            'respuestasAllPreguntas' => $this->respuestas
                ->allPreguntas()
                ->withPivot(['activo'])
                ->paginate(20),
        ]);
    }
}
