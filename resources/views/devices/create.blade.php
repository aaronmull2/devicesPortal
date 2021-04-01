@extends('layout')

@section('header') Create Device @endsection

@section ('content')

<form method="POST" action="/devices">
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
        <label class="col-sm-2 col-form-label" for="site_id">Active</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('active') is-invalid @enderror" name="active" id="active">
                <option value="1">Active</option>
                <option value="0">Not Active</option>
            </select>
        </div>
        @error('active')
                <p class="text-danger">{{ $errors->first('active') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="site_id">Site</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('site_id') is-invalid @enderror" name="site_id" id="site_id">
                @foreach ($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
        </div>
        @error('site_id')
                <p class="text-danger">{{ $errors->first('site_id') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="device_status_id">Status</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('device_status_id') is-invalid @enderror" name="device_status_id" id="device_status_id">
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        @error('device_status_id')
                <p class="text-danger">{{ $errors->first('device_status_id') }}</p>
        @enderror  
    </div> 
    <div class="form-group">
        <div class="col-sm-10">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
@endsection