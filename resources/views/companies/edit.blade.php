@extends('layout')

@section('header') Edit Company @endsection

@section ('content')

<form method="POST" action="/companies/{{ $company->id }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $company->name }}">
            @error('name')
                <p class="text-danger">{{ $errors->first('name') }}</p>
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