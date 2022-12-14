<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

    /**
     *Task一覧の表示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderByDesc("id")->get();
    }

    /**
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $TaskRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTaskRequest $TaskRequest)
    {

        $task = Task::create($TaskRequest->all());

        return $task
            ? response()->json($task, 201)
            : response()->json([], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $TaskRequest
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTaskRequest $TaskRequest, Task $task)
    {
        $task->title = $TaskRequest->title;

        return $task->update()
            ? response()->json($task, 201)
            : response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        return $task->delete()
            ? response()->json($task)
            : response()->json([], 500);
    }
}
