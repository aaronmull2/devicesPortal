@extends('layout')

@section('header') Create Company @endsection

@section ('content')

<form method="POST" action="/companies">
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
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
@endsection