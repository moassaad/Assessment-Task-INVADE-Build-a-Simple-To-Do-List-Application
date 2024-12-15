@extends('layout.app')
@section('title', 'Home')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center;">
                <h1>Hello <strong>{{auth()->user()->name}}</strong></h1>
                <h3>Welcome to {{env('APP_NAME')}}</h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <hr>
                <div>
                    <h2>Catigory</h2>
                    <p>You can show and create new catigory and more from catigory index.</p>
                    <a href="{{route('catigory.index')}}" class="btn btn-success m-3">Catigory List</a>
                </div>
                <hr>
                <div>
                    <h2>Task</h2>
                    <p>You can show and create new task and more from task index.</p>
                    <a href="{{route('task.index')}}" class="btn btn-success m-3">Task List</a>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection