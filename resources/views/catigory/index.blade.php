@extends('layout.app')
@section('title', 'Catigory')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center;">
                <h1>Catigory List</h1>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center;">
                @include('catigory.create')
                <a href="" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#newCatigory">New Catigory</a>
            </div>
            @if ($catigories->isEmpty())
                <div class="col-md-12" style="text-align: center;">
                    <h5 class="card-title">You don't have a catigories.</h5><br>
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Catigory Name</th>
                            <th>Catigory Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catigories as $catigory)
                            <tr>
                                <td>{{$catigory->catigory_name}}</td>
                                <td>
                                    <span class="badge" style="background-color: {{$catigory->color}};">
                                        {{$catigory->color}}
                                    </span>
                                </td>
                                <td>
                                    @include('catigory.edit')
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#_{{$catigory->catigory_id}}">edit</button>
                                    <form method="post" action="{{route('catigory.destroy',$catigory)}}" class="btn">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (!$catigories->isEmpty())
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if(!$catigories->previousPageUrl()) disabled @endif">
                            <a class="page-link"  @if($catigories->previousPageUrl()) href="{{$catigories->previousPageUrl()}}" @endif >
                                Previous
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link">[{{$catigories->currentPage()}}-{{$catigories->lastPage()}}]</a>
                        </li>
                        <li class="page-item @if(!$catigories->nextPageUrl()) disabled @endif">
                            <a class="page-link" @if($catigories->nextPageUrl()) href="{{$catigories->nextPageUrl()}}" @endif>
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection