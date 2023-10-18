<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\Tasks\StoreTasksRequest;
use App\Http\Requests\Tasks\UpdateTasksRequest;

class TasksController extends Controller
{
    private $tasks;

    public function __construct(Tasks $tasks) {
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TasksResourceCollection($this->tasks->index());
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
    public function store(StoreTasksRequest $request)
    {
        try {
            $data = $this
            ->tasks
            ->store($request->all());
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.store', null, $e);
        }
        return new TasksResource($data, array('type' => 'store', 'route' => 'tasks.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = $this
            ->tasks
            ->show($id);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.show', $id, $e);
        }
        return new TasksResource($data, array('type' => 'show', 'route' => 'tasks.show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    public function tasksByList($id) {
        try {
            $data = $this
            ->tasks
            ->tasksByList($id);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.tasksByList', $id, $e);
        }
        return new TasksResourceCollection($data);
    }

    public function closeTask($id) {
        try {
            $data = $this
            ->tasks
            ->closeTask($id);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.closeTask', $id, $e);
        }
        return new TasksResource($data, array('type' => 'update', 'route' => 'tasks.closeTask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        try {
            $data = $this
            ->tasks
            ->updateTask($request->all(), $id);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.update', $id, $e);
        }
        return new TasksResource($data, array('type' => 'update', 'route' => 'tasks.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        try {
            $data = $this
            ->tasks
            ->destroy($id);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('tasks.destroy', $id, $e);
        }
        return new TasksResource($data, array('type' => 'destroy', 'route' => 'tasks.destroy'));
    }
}
