@extends('layout')

@section('header') Create Site @endsection

@section ('content')

<form method="POST" action="/sites">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}">     
        </div>
        @error('name')
                <p class="text-danger">{{ $errors->first('name') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="location_id">Type</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('location_id') is-invalid @enderror" name="alert_type_id" id="alert_type_id">
                @foreach ($locations as $location)
                <option value="{{ $location->id }}">{{ $location->address_line_1 }}, {{ $location->city_town }}, {{ $location->postcode }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection