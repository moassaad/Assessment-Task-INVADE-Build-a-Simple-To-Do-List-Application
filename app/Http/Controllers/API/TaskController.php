<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\TaskResource;
use App\Models\Catigory;
use App\Models\Task;
use App\Services\APIResponse;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where(['user_id'=>$user->user_id])
            ->orderBy('created_at','desc')->paginate(12);
        return APIResponse::new()
            ->successOk('success', new PaginateResource($tasks, TaskResource::class));
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
    public function store(TaskRequest $request)
    {
        $valid = $request->validated();
        $completion = (isset($valid['completion']))? true : false;
        Task::create([
            'task_id'=>\Str::random(64),
            'title'=>$valid['title'],
            'description'=>$valid['description'],
            'status'=>$completion,
            'due_date'=>$valid['due_date'],
            'catigory_id'=>$valid['catigory'],
            'user_id'=>Auth::user()->user_id
        ]);
        return APIResponse::new()->successCreated('success add new task!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return APIResponse::new()->successOk('success', $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $valid = $request->validated();
        // return response($valid);
        $completion = (isset($valid['completion']))? true : false;
        $task->title = $valid['title'];
        $task->description = $valid['description'];
        $task->status = $completion;
        $task->due_date = $valid['due_date'];
        $task->catigory_id = $valid['catigory'];
        $task->update();
        return APIResponse::new()->successOk('success update task!', new TaskResource($task));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $check = $task->delete();
        if($check)
        {
            return APIResponse::new()->successOk('success deleted task.', new TaskResource($task));
        }
    }
    public function completion(Task $task)
    {
        $task->status = ($task->status)? false : true;
        $check = $task->update();
        if($check)
        {
            return APIResponse::new()->successOk('success updated task.', new TaskResource($task));
        }
    }
    public function taskToday()
    {
        $user = Auth::user();
        $tasks = Task::where(['user_id'=>$user->user_id,'due_date'=>date("Y-m-d")])
            ->orderBy('created_at','desc')->paginate(12);
        return APIResponse::new()->successOk('success', new PaginateResource($tasks, TaskResource::class));
    }
    public function filterCatigory($catigory_id)
    {
        $user = Auth::user();
        $tasks = Task::where(['user_id'=>$user->user_id,'catigory_id'=>$catigory_id])
            ->orderBy('created_at','desc')->paginate(12);
        return APIResponse::new()->successOk('success', new PaginateResource($tasks, TaskResource::class));
    }
    public function filterCompletion(string $status)
    {
        // completed - pending
        $user = Auth::user();
        $completion = ($status !== "pending") ? true : false;
        $tasks = Task::where(['user_id'=>$user->user_id,'status'=>$completion])
            ->orderBy('created_at','desc')->paginate(12);
        return APIResponse::new()->successOk('success', new PaginateResource($tasks, TaskResource::class));

    }
}
