<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Catigory;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $catigories = Catigory::where(['user_id'=>$user->user_id])->get();
        $title = "All Today";
        $tasks = Task::where(['user_id'=>$user->user_id])
            ->orderBy('created_at','desc')->paginate(12);
        // return response($tasks);
        return view('task.index',compact(['title','tasks','catigories']));
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
        return back()->with('success','success add new task!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
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
        return back()->with('success','success update task!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $check = $task->delete();
        if($check)
        {
            return back()->with('success','success deleted task.');
        }
    }
    public function completion(Task $task)
    {
        $task->status = ($task->status)? false : true;
        $check = $task->update();
        if($check)
        {
            return back()->with('success','success deleted task.');
        }
    }
    public function taskToday()
    {
        $user = Auth::user();
        $catigories = Catigory::where(['user_id'=>$user->user_id])->get();
        $title = "Task Today";
        $tasks = Task::where(['user_id'=>$user->user_id,'due_date'=>date("Y-m-d")])
            ->orderBy('created_at','desc')->paginate(12);
        return view('task.index',compact(['title','tasks','catigories']));
    }
    public function filterCatigory($catigory_id)
    {
        $user = Auth::user();
        $catigories = Catigory::where(['user_id'=>$user->user_id])->get();
        $title = "Task Today";
        $tasks = Task::where(['user_id'=>$user->user_id,'catigory_id'=>$catigory_id])
            ->orderBy('created_at','desc')->paginate(12);
        return view('task.index',compact(['title','tasks','catigories']));
    }
    public function filterCompletion(string $status)
    {
        $user = Auth::user();
        $catigories = Catigory::where(['user_id'=>$user->user_id])->get();
        $completion = ($status !== "pending") ? true : false;
        
        $title = "Task $status";
        $tasks = Task::where(['user_id'=>$user->user_id,'status'=>$completion])
            ->orderBy('created_at','desc')->paginate(12);
        return view('task.index',compact(['title','tasks','catigories']));
    }
}
