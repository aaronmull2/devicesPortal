@extends('layout')

@section('header') View Site @endsection

@section ('content')

    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" value="{{ $site->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_1">Address Line 1</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address_line_1" id="address_line_1" value="{{ $site->location->address_line_1 }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="address_line_2">Address Line 2</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address_line_2" id="address_line_2" value="{{ $site->location->address_line_2 }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="city_town">City/Town</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="city_town" id="city_town" value="{{ $site->location->city_town }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="county">County</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="county" id="county" value="{{ $site->location->county }}" disabled>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="postcode">Postcode</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="postcode" id="postcode" value="{{ $site->location->postcode }}" disabled>  
        </div>
    </div>
    @if($rName === "admin" || $rName === "super")
    <div class="btn-toolbar">
        <form method="GET" action="/sites/{{ $site->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        @if($rName === "super")
        <form method="POST" action="/sites/{{ $site->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete site?')" type="submit">Delete</button>
        </form>
        @endif
    </div>
    @endif
@endsection