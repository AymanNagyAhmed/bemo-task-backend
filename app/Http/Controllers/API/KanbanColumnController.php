<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StorekanbanColumnRequest;
use App\Http\Requests\UpdatekanbanColumnRequest;
use App\Models\kanbanColumn;
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
        return $this->sendResponse(KanbanColumnResource::collection(kanbanColumn::all()), "retrieved successufully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorekanbanColumnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekanbanColumnRequest $request)
    {
        $validated = $request->validated();
        $kanbanColumn = KanbanColumn::create($validated);
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "created successufully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function show(kanbanColumn $kanbanColumn)
    {
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "retrieved successufully");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekanbanColumnRequest  $request
     * @param  \App\Models\kanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekanbanColumnRequest $request, kanbanColumn $kanbanColumn)
    {
        $validated = $request->validated();
        $kanbanColumn->update($validated);
        return $this->sendResponse(new KanbanColumnResource($kanbanColumn), "updated successufully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kanbanColumn  $kanbanColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(kanbanColumn $kanbanColumn)
    {
        $kanbanColumn->delete();
        return  $this->sendResponse([], "deleted Successfully");
    }
}
