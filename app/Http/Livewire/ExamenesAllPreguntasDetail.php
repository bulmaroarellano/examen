<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Examenes;
use App\Models\Preguntas;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExamenesAllPreguntasDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Examenes $examenes;
    public Preguntas $preguntas;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Preguntas';

    protected $rules = [
        'preguntas.desPregunta' => ['required', 'max:255', 'string'],
        'preguntas.activo' => ['required', 'boolean'],
    ];

    public function mount(Examenes $examenes)
    {
        $this->examenes = $examenes;
        $this->resetPreguntasData();
    }

    public function resetPreguntasData()
    {
        $this->preguntas = new Preguntas();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPreguntas()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.examenes_all_preguntas.new_title');
        $this->resetPreguntasData();

        $this->showModal();
    }

    public function editPreguntas(Preguntas $preguntas)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.examenes_all_preguntas.edit_title');
        $this->preguntas = $preguntas;

        $this->dispatchBrowserEvent('refresh');

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

        if (!$this->preguntas->idExamen) {
            $this->authorize('create', Preguntas::class);

            $this->preguntas->idExamen = $this->examenes->id;
        } else {
            $this->authorize('update', $this->preguntas);
        }

        $this->preguntas->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Preguntas::class);

        Preguntas::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPreguntasData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->examenes->allPreguntas as $preguntas) {
            array_push($this->selected, $preguntas->id);
        }
    }

    public function render()
    {
        return view('livewire.examenes-all-preguntas-detail', [
            'allPreguntas' => $this->examenes->allPreguntas()->paginate(20),
        ]);
    }
}
