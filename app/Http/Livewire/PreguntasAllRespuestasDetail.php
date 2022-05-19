<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Preguntas;
use App\Models\Respuestas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PreguntasAllRespuestasDetail extends Component
{
    use AuthorizesRequests;

    public Preguntas $preguntas;
    public Respuestas $respuestas;
    public $allRespuestasForSelect = [];
    public $respuestas_id = null;
    public $activo;

    public $showingModal = false;
    public $modalTitle = 'New Respuestas';

    protected $rules = [
        'respuestas_id' => ['required', 'exists:tblrespuestas,id'],
        'activo' => ['required', 'boolean'],
    ];

    public function mount(Preguntas $preguntas)
    {
        $this->preguntas = $preguntas;
        $this->allRespuestasForSelect = Respuestas::pluck('desRespuesta', 'id');
        $this->resetRespuestasData();
    }

    public function resetRespuestasData()
    {
        $this->respuestas = new Respuestas();

        $this->respuestas_id = null;
        $this->activo = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newRespuestas()
    {
        $this->modalTitle = trans('crud.preguntas_all_respuestas.new_title');
        $this->resetRespuestasData();

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

        $this->authorize('create', Respuestas::class);

        $this->preguntas->allRespuestas()->attach($this->respuestas_id, [
            'activo' => $this->activo,
        ]);

        $this->hideModal();
    }

    public function detach($respuestas)
    {
        $this->authorize('delete-any', Respuestas::class);

        $this->preguntas->allRespuestas()->detach($respuestas);

        $this->resetRespuestasData();
    }

    public function render()
    {
        return view('livewire.preguntas-all-respuestas-detail', [
            'preguntasAllRespuestas' => $this->preguntas
                ->allRespuestas()
                ->withPivot(['activo'])
                ->paginate(20),
        ]);
    }
}
