@extends('layout')

@section('header') View Device @endsection

@section ('content')

    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" value="{{ $device->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="active">Active</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="active" id="active" value="@if($device->active == 0) Not Active @elseif($device->active == 1) Active @endif" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="site_id">Site</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="site_id" id="site_id" value="{{ $device->site->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="device_status_id">Status</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="device_status_id" id="device_status_id" value="{{ $device->deviceStatus->name }}" disabled>     
        </div>
    </div>
    @if($rName === "admin" || $rName === "super")
    <div class="btn-toolbar">
        <form method="GET" action="/devices/{{ $device->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        @if($rName === "super")
        <form method="POST" action="/devices/{{ $device->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete this device?')" type="submit">Delete</button>
        </form>
        @endif
    </div>
    @endif
@endsection