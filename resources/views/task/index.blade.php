@extends('layout.app')
@section('title', $title)
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center;">
                <h1>Hello <strong>{{auth()->user()->name}}</strong></h1>
                <h3>Welcome to {{$title}}</h3>
            </div>
            <div class="col-md-12 mb-3 justify-content-flexend" style="text-align: center;">
                @include('task.create')
                <a href="" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#newTask">New Task</a>
                @include('catigory.create')
                <a href="" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#newCatigory">New Catigory</a>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <hr>
            <div class="col-md-12">
                <span>Filter with catirory: </span>
                @forelse ($catigories as $catigory)
                    <a href="{{route('task.filter.catigory',$catigory->catigory_id)}}" class="btn btn-dark " >{{$catigory->catigory_name}}</a>
                @empty
                    <h5 class="card-title">You don't have a catigories.</h5><br>
                @endforelse
            </div>
            <div class="col-md-12 ">
                <span>Filter with completion : </span>
                <a href="{{route('task.filter.completion',"completed")}}" class="btn badge bg-success ">completed</a>
                <a href="{{route('task.filter.completion',"pending")}}" class="btn badge bg-warning m-3">pending</a>
            </div>
            <hr>
            @forelse ($tasks as $task)
                <div class="col-md-4 mb-3" *ngFor="let task of tasks">
                    <div class="card" style="background-color: @if ($task->status) #efefef @endif">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <div>
                                <span class="badge badge-pill " style="background: {{$task->catigory->color}}">
                                    {{$task->catigory->catigory_name}}
                                </span>
                                <span class="badge badge-pill @if($task->status == true) bg-success @else bg-warning @endif">
                                    @if($task->status == true) completed @else pending @endif
                                </span>
                            </div>
                            <p class="card-text">{{ $task->description }}</p>
                            <p class="card-text"><small class="text-muted">{{ $task->due_date }}</small></p>
                            <form method="post" action="{{route('task.completion',$task)}}" class="btn">
                                @csrf
                                @method('PATCH')
                                <button  type="submit" class="btn btn-outline-dark">
                                    @if ($task->status)
                                        uncheck
                                    @else
                                        check
                                    @endif
                                </button>
                            </form>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#_{{$task->task_id}}">edit</button>
                            <form method="post" action="{{route('task.destroy',$task)}}" class="btn">
                                @csrf
                                @method('DELETE')
                                <button  type="submit" class="btn btn-danger">delete</button>
                            </form>
                            @include('task.edit')
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12" style="text-align: center;">
                    <h5 class="card-title">You don't have a tasks.</h5><br>
                </div>
            @endforelse
            @if (!$tasks->isEmpty())
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if(!$tasks->previousPageUrl()) disabled @endif">
                            <a class="page-link"  @if($tasks->previousPageUrl()) href="{{$tasks->previousPageUrl()}}" @endif >
                                Previous
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link">[{{$tasks->currentPage()}}-{{$tasks->lastPage()}}]</a>
                        </li>
                        <li class="page-item @if(!$tasks->nextPageUrl()) disabled @endif">
                            <a class="page-link" @if($tasks->nextPageUrl()) href="{{$tasks->nextPageUrl()}}" @endif>
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif

        </div>
    </div>
@endsection