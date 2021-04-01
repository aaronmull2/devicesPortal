@extends('layout')

@section('header') View Company @endsection

@section ('content')

    <div class="form-group">
        <label class="col-sm-2 col-form-label" for="name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}" disabled>     
        </div>
    </div>
    @if($rName === "super")
    <div class="btn-toolbar">
        <form method="GET" action="/companies/{{ $company->id }}/edit">
            @csrf
            <button class="btn btn-primary mx-2" type="submit">Edit</button>
        </form>
        @if($rName === "super")
        <form method="POST" action="/companies/{{ $company->id }}/delete">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete company?')" type="submit">Delete</button>
        </form>
        @endif
    </div>
    @endif
@endsection