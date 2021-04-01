@extends('layout')

@section('header') View User @endsection

@section ('content')

    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="email">Email</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="email" id="email" value="{{ $user->email }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="role_id">Role</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="role_id" id="role_id" value="{{ $user->role->title }}" disabled>  
        </div>
    </div>
    @if($rName === "admin" || $rName === "super")
    <div class="btn-toolbar">
        <form method="GET" action="/users/{{ $user->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        <form method="POST" action="/users/{{ $user->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete user?')" type="submit">Delete</button>
        </form>
    </div>
    @endif
@endsection