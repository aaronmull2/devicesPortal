@extends('layout')

@section('header') View Alert @endsection

@section ('content')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="title">Title</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="title" id="title" value="{{ $alert->title }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="message">Message</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="message" id="message" value="{{ $alert->message }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="status" id="status" value="{{ $alert->alertStatus->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="user">Assigned To</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="user" id="user" value="{{ $alert->user->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="type">Type</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="type" id="type" value="{{ $alert->alertType->title }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="site">Site</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="site" id="site" value="{{ $alert->device->site->name }}" disabled>     
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="device">Device</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="device" id="device" value="{{ $alert->device->name }}" disabled>     
        </div>
    </div>
    <div class="btn-toolbar">
        <form method="POST" action="/alerts/{{ $alert->id }}/complete">
            @csrf
            @method('PUT')
            <button class="btn btn-success mx-2" type="submit">Complete</button>
        </form>
        @if($rName === "admin" || $rName === "super")
        <form method="GET" action="/alerts/{{ $alert->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        <form method="POST" action="/alerts/{{ $alert->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete this alert?')" type="submit">Delete</button>
        </form>
        @endif
</div>
@endsection