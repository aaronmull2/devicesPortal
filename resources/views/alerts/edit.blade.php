@extends('layout')

@section('header') Edit Alert @endsection

@section ('content')

<form method="POST" action="/alerts/{{ $alert->id }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="title">Title</label>
        <div class="col-sm-10">
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ $alert->title }}">     
        </div>
        @error('title')
                <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="message">Message</label>
        <div class="col-sm-10">
            <input class="form-control @error('message') is-invalid @enderror" type="text" name="message" id="message" value="{{ $alert->message }}">     
        </div>
        @error('message')
                <p class="text-danger">{{ $errors->first('message') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="alert_status_id">Status</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2" name="alert_status_id" id="alert_status_id">
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" @if(($alert->alert_status_id) === ($status->id)) selected="selected"  @endif>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="alert_type_id">Type</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('alert_type_id') is-invalid @enderror" name="alert_type_id" id="alert_type_id">
                @foreach ($types as $type)
                <option value="{{ $type->id }}" @if(($alert->alert_type_id) === ($type->id)) selected="selected"  @endif>{{ $type->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="user_id">Assigned User</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @if(($alert->user_id) === ($user->id)) selected="selected"  @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="btn-toolbar">
        <button class="btn btn-primary mx-2" type="submit">Save</button>
    </div>
</form>
@endsection