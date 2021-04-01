@extends('layout')

@section('header') Edit Location @endsection

@section ('content')

<form method="POST" action="/locations/{{ $location->id }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_1">Address Line 1</label>
        <div class="col-sm-10">
            <input class="form-control @error('address_line_1') is-invalid @enderror" type="text" name="address_line_1" id="address_line_1" value="{{ $location->address_line_1 }}">  
        </div>
        @error('address_line_1')
                <p class="text-danger">{{ $errors->first('address_line_1') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_2">Address Line 2</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address_line_2" id="address_line_2" value="{{ $location->address_line_2 }}">  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="city_town">City/Town</label>
        <div class="col-sm-10">
            <input class="form-control @error('city_town') is-invalid @enderror" type="text" name="city_town" id="city_town" value="{{ $location->city_town }}">  
        </div>
        @error('city_town')
                <p class="text-danger">{{ $errors->first('city_town') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="county">County</label>
        <div class="col-sm-10">
            <input class="form-control @error('county') is-invalid @enderror" type="text" name="county" id="county" value="{{ $location->county }}">  
        </div>
        @error('county')
                <p class="text-danger">{{ $errors->first('county') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="postcode">Postcode</label>
        <div class="col-sm-10">
            <input class="form-control @error('postcode') is-invalid @enderror" type="text" name="postcode" id="postcode" value="{{ $location->postcode }}">  
        </div>
        @error('postcode')
                <p class="text-danger">{{ $errors->first('postcode') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="lat">Latitude</label>
        <div class="col-sm-10">
            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ $location->lat }}">  
        </div>
        @error('lat')
                <p class="text-danger">{{ $errors->first('lat') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="lng">Longitude</label>
        <div class="col-sm-10">
            <input class="form-control @error('lng') is-invalid @enderror" type="text" name="lng" id="lng" value="{{ $location->lng }}">  
        </div>
        @error('lng')
                <p class="text-danger">{{ $errors->first('lng') }}</p>
        @enderror 
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection