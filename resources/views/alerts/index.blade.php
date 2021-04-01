@extends('layout')

@section('header') Alerts @endsection

@section('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Site</th>
        <th>Action</th>
    </tr>
    @foreach ($alerts as $alert)
    <tr>
        <td class="tbl-index">{{ $alert->id }}</td>
        <td class="tbl-index">{{ $alert->title }}</td>
        <td class="tbl-index">{{ $alert->device->site->name }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/alerts/{{ $alert->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/alerts/{{ $alert->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endforeach
</table>
@endsection