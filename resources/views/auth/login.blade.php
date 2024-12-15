@extends('layout.app')
@section('title', 'Login')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center;">
                <h1>Hello</h1>
                <h3>Welcome to {{env('APP_NAME')}}</h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                @error('error')<em style="color:red;">{{$message}}</em>@enderror
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" aria-describedby="emailHelp">
                        @error('email')
                            <em style="color:red;">{{$message}}</em>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        @error('password')
                            <em style="color:red;">{{$message}}</em>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">login</button>
                    <a href="{{route('register')}}" class="m-3"> i don't have account, create new.</a>
                </form>
            </div>
        </div>
    </div>
@endsection
