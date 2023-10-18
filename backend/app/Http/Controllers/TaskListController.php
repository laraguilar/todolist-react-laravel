<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Requests\StoreTaskListRequest;
use App\Http\Requests\UpdateTaskList;
use App\Services\ResponseService;
use App\Transformers\TaskList\TaskListResource;
use App\Transformers\TaskList\TaskListResourceCollection;

class TaskListController extends Controller
{
    private $taskList;

    public function __construct(TaskList $tasklist){
        $this->tasklist = $tasklist;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TaskListResourceCollection($this->taskList->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskListRequest $request)
    {
        try {
            $data = $this
            ->taskList
            ->create($request->all());
        } catch(\Throwable | \Excepction $e) {
            return ResponseService::exception('tasklist.store', null, $e);
        }
        return new TaskListResource($data, array('type' => 'store', 'route' => 'tasklist.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = $this
            ->taskList
            ->show($id);
        } catch(\Throwable|\Exception $e) {
            return ResponseService::exception('tasklist.show', null, $e);
        }

        return new TaskListResource($data, array(['type' => 'show', 'route' => 'tasklist.show']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskList $taskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $this
            ->taskList
            ->updateList($request->all(), $id);
        } catch(\Throwable|\Exception $e) {
            return ResponseService::exception('tasklist.update', $id, $e);
        }

        return new TaskListResource($data, array(['type' => 'update', 'route' => 'tasklist.update']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = $this
            ->taskList
            ->destroyList($id);
        } catch(\Throwable|\Exception $e) {
            return ResponseService::exception('tasklist.destroy', $id, $e);
        }
        return new TaskListResource($data, array(['type' => 'destroy', 'route' => 'tasklist.destroy']));
    }
}
