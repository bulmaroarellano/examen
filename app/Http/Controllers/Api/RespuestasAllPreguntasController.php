<?php
namespace App\Http\Controllers\Api;

use App\Models\Preguntas;
use App\Models\Respuestas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PreguntasCollection;

class RespuestasAllPreguntasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Respuestas $respuestas)
    {
        $this->authorize('view', $respuestas);

        $search = $request->get('search', '');

        $allPreguntas = $respuestas
            ->allPreguntas()
            ->search($search)
            ->latest()
            ->paginate();

        return new PreguntasCollection($allPreguntas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @param \App\Models\Preguntas $preguntas
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Respuestas $respuestas,
        Preguntas $preguntas
    ) {
        $this->authorize('update', $respuestas);

        $respuestas->allPreguntas()->syncWithoutDetaching([$preguntas->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @param \App\Models\Preguntas $preguntas
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Respuestas $respuestas,
        Preguntas $preguntas
    ) {
        $this->authorize('update', $respuestas);

        $respuestas->allPreguntas()->detach($preguntas);

        return response()->noContent();
    }
}
