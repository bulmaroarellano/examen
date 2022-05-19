<?php

namespace App\Http\Controllers\Api;

use App\Models\Examenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamenesResource;
use App\Http\Resources\ExamenesCollection;
use App\Http\Requests\ExamenesStoreRequest;
use App\Http\Requests\ExamenesUpdateRequest;

class ExamenesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Examenes::class);

        $search = $request->get('search', '');

        $allExamenes = Examenes::search($search)
            ->latest()
            ->paginate();

        return new ExamenesCollection($allExamenes);
    }

    /**
     * @param \App\Http\Requests\ExamenesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamenesStoreRequest $request)
    {
        $this->authorize('create', Examenes::class);

        $validated = $request->validated();

        $examenes = Examenes::create($validated);

        return new ExamenesResource($examenes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Examenes $examenes)
    {
        $this->authorize('view', $examenes);

        return new ExamenesResource($examenes);
    }

    /**
     * @param \App\Http\Requests\ExamenesUpdateRequest $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function update(ExamenesUpdateRequest $request, Examenes $examenes)
    {
        $this->authorize('update', $examenes);

        $validated = $request->validated();

        $examenes->update($validated);

        return new ExamenesResource($examenes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Examenes $examenes)
    {
        $this->authorize('delete', $examenes);

        $examenes->delete();

        return response()->noContent();
    }
}
