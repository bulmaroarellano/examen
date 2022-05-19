<?php

namespace App\Http\Controllers;

use App\Models\Examenes;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.all_examenes.index', compact('allExamenes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Examenes::class);

        return view('app.all_examenes.create');
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

        return redirect()
            ->route('all-examenes.edit', $examenes)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Examenes $examenes)
    {
        $this->authorize('view', $examenes);

        return view('app.all_examenes.show', compact('examenes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examenes $examenes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Examenes $examenes)
    {
        $this->authorize('update', $examenes);

        return view('app.all_examenes.edit', compact('examenes'));
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

        return redirect()
            ->route('all-examenes.edit', $examenes)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-examenes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
