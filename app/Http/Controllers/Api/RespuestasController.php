<?php

namespace App\Http\Controllers\Api;

use App\Models\Respuestas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RespuestasResource;
use App\Http\Resources\RespuestasCollection;
use App\Http\Requests\RespuestasStoreRequest;
use App\Http\Requests\RespuestasUpdateRequest;

class RespuestasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Respuestas::class);

        $search = $request->get('search', '');

        $allRespuestas = Respuestas::search($search)
            ->latest()
            ->paginate();

        return new RespuestasCollection($allRespuestas);
    }

    /**
     * @param \App\Http\Requests\RespuestasStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RespuestasStoreRequest $request)
    {
        $this->authorize('create', Respuestas::class);

        $validated = $request->validated();

        $respuestas = Respuestas::create($validated);

        return new RespuestasResource($respuestas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Respuestas $respuestas)
    {
        $this->authorize('view', $respuestas);

        return new RespuestasResource($respuestas);
    }

    /**
     * @param \App\Http\Requests\RespuestasUpdateRequest $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function update(
        RespuestasUpdateRequest $request,
        Respuestas $respuestas
    ) {
        $this->authorize('update', $respuestas);

        $validated = $request->validated();

        $respuestas->update($validated);

        return new RespuestasResource($respuestas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Respuestas $respuestas)
    {
        $this->authorize('delete', $respuestas);

        $respuestas->delete();

        return response()->noContent();
    }
}
