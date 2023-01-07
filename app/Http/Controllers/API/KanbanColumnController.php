<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreKanbanColumnRequest;
use App\Http\Requests\UpdateKanbanColumnRequest;
use App\Models\KanbanColumn;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\KanbanColumnResource;

class KanbanColumnController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(KanbanColumnResource::collection(KanbanColumn::all()), "retrieved successufully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKanbanColumnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKanbanColumnRequest $request)
    {
        $validated = $request->validated();
        $kanbanColumn = KanbanColumn::create($validated);
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "created successufully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function show(KanbanColumn $kanbanColumn)
    {
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "retrieved successufully");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKanbanColumnRequest  $request
     * @param  \App\Models\KanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKanbanColumnRequest $request, KanbanColumn $kanbanColumn)
    {
        $validated = $request->validated();
        $kanbanColumn->update($validated);
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "updated successufully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(KanbanColumn $kanbanColumn)
    {
        $kanbanColumn->delete();
        return  $this->sendResponse([], "deleted Successfully");
    }
}
