@extends('layout')

@section('header') Edit User @endsection

@section ('content')

<form method="POST" action="/users/{{ $user->id }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $user->name }}">
            @error('name')
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @enderror  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="email">Email</label>
        <div class="col-sm-10">
        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ $user->email }}">
            @error('email')
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @enderror   
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="role_id">Role</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('role_id') is-invalid @enderror" name="role_id" id="role_id" value="{{ old('role_id') }}">
                @if($rName == "super")
                    @foreach($roles as $role)
                        @if($role->title != "super")
                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                        @endif
                    @endforeach
                @else
                @foreach($roles as $role)
                        @if($role->title != "super" && $role->title != "admin")
                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            @error('role_id')
                <p class="text-danger">{{ $errors->first('role_id') }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection