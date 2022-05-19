<?php

namespace App\Http\Controllers;

use App\Models\Respuestas;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_respuestas.index',
            compact('allRespuestas', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Respuestas::class);

        return view('app.all_respuestas.create');
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

        return redirect()
            ->route('all-respuestas.edit', $respuestas)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Respuestas $respuestas)
    {
        $this->authorize('view', $respuestas);

        return view('app.all_respuestas.show', compact('respuestas'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Respuestas $respuestas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Respuestas $respuestas)
    {
        $this->authorize('update', $respuestas);

        return view('app.all_respuestas.edit', compact('respuestas'));
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

        return redirect()
            ->route('all-respuestas.edit', $respuestas)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-respuestas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
