<?php

namespace App\Http\Controllers\Api;

use App\Models\Examenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PreguntasResource;
use App\Http\Resources\PreguntasCollection;

class ExamenesAllPreguntasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Examenes $examenes)
    {
        $this->authorize('view', $examenes);

        $search = $request->get('search', '');

        $allPreguntas = $examenes
            ->allPreguntas()
            ->search($search)
            ->latest()
            ->paginate();

        return new PreguntasCollection($allPreguntas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Examenes $examenes)
    {
        $this->authorize('create', Preguntas::class);

        $validated = $request->validate([
            'desPregunta' => ['required', 'max:255', 'string'],
            'activo' => ['required', 'boolean'],
        ]);

        $preguntas = $examenes->allPreguntas()->create($validated);

        return new PreguntasResource($preguntas);
    }
}
