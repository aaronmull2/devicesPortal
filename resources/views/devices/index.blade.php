@extends('layout')

@section('header') Devices @endsection

@section ('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Site</th>
        <th>Action</th>
    </tr>
    @foreach ($devices as $device)
    <tr>
        <td class="tbl-index">{{ $device->id }}</td>
        <td class="tbl-index">{{ $device->name }}</td>
        <td class="tbl-index">{{ $device->site->name }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/devices/{{ $device->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/devices/{{ $device->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endforeach
</table>
@endsection