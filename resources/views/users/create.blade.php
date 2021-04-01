@extends('layout')

@section('header') Create User @endsection

@section ('content')

<form method="POST" action="/users">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @enderror        
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="email">Email</label>
        <div class="col-sm-10">
            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @enderror        
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="role_id">Role</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('role_id') is-invalid @enderror" name="role_id" id="role_id" value="{{ old('role_id') }}">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->title }}</option>
                @endforeach
            </select>
            @error('role_id')
                <p class="text-danger">{{ $errors->first('role_id') }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="password">Password</label>
        <div class="col-sm-10">
            <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password">
            @error('password')
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
@endsection