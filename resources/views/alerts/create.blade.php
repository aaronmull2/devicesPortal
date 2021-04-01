@extends('layout')

@section('header') Create Alert @endsection

@section ('content')

<form method="POST" action="/alerts">
    @csrf
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="title">Title</label>
        <div class="col-sm-10">
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}">     
        </div>
        @error('title')
                <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="message">Message</label>
        <div class="col-sm-10">
            <input class="form-control @error('message') is-invalid @enderror" type="text" name="message" id="message" value="{{ old('message') }}">     
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
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="alert_type_id">Type</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('alert_type_id') is-invalid @enderror" name="alert_type_id" id="alert_type_id">
                @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>
        </div>
        @error('type')
                <p class="text-danger">{{ $errors->first('type') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="user_id">Assigned User</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        @error('user_id')
                <p class="text-danger">{{ $errors->first('user_id') }}</p>
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
        <label class="col-sm-2 col-form-label" for="device_id">Device</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('device_id') is-invalid @enderror" name="device_id" id="device_id">

            </select>
        </div>
        @error('device_id')
                <p class="text-danger">{{ $errors->first('device_id') }}</p>
        @enderror  
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="priority">Priority</label>
        <div class="col-sm-10"> 
            <select class="custom-select mr-sm-2 @error('priority') is-invalid @enderror" name="priority" id="priority">
                <option value="1">1 - Low</option>
                <option value="2">2 - Medium</option>
                <option value="3">3 - HIgh</option>
            </select>
        </div>
        @error('priority')
                <p class="text-danger">{{ $errors->first('priority') }}</p>
        @enderror  
    </div>
    <div class="btn-toolbar">
        <button class="btn btn-primary mx-2" type="submit">Submit</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
$("#site_id").prepend($('<option selected="selected">Select a Site</option>'));
$("#device_id").prepend($('<option selected="selected">Select a Device (After selecting a Site)</option>'));
$("#site_id").change(function() {
    var devices = {!! json_encode($devices) !!};
    var site_id = $("#site_id").val();
    var i=0;
    var dSelect = $("#device_id");
    dSelect.empty();
    for(i=0;i<devices.length;i++) {
        if (site_id == devices[i].site_id) {
            var opt = document.createElement("option");
            opt.value = devices[i].id;
            opt.innerHTML = devices[i].name;
            dSelect.append(opt);
        }
    }
});
</script>
@endsection