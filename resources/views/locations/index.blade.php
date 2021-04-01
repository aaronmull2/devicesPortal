@extends('layout')

@section('header') Locations @endsection

@section('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>City/Town</th>
        <th>Action</th>
    </tr>
    @foreach ($locations as $location)
    <tr>
        <td class="tbl-index">{{ $location->id }}</td>
        <td class="tbl-index">{{ $location->site->name }}</td>
        <td class="tbl-index">{{ $location->city_town }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/locations/{{ $location->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/locations/{{ $location->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endforeach
</table>
@endsection