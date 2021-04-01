@extends('layout')

@section('header') View Location @endsection

@section ('content')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_1">Address Line 1</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address_line_1" id="address_line_1" value="{{ $location->address_line_1 }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_2">Address Line 2</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address_line_2" id="address_line_2" value="{{ $location->address_line_2 }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="city_town">City/Town</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="city_town" id="city_town" value="{{ $location->city_town }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="county">County</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="county" id="county" value="{{ $location->county }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="postcode">Postcode</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="postcode" id="postcode" value="{{ $location->postcode }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="lat">Latitude</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="lat" id="lat" value="{{ $location->lat }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="lng">Longitude</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="lng" id="lng" value="{{ $location->lng }}" disabled>  
        </div>
    </div>
    @if($rName === "admin" || $rName === "super")
    <div class="btn-toolbar">
        <form method="GET" action="/locations/{{ $location->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        @if($rName === "super")
        <form method="POST" action="/locations/{{ $location->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete location?')" type="submit">Delete</button>
        </form>
        @endif
    </div>
    @endif
@endsection