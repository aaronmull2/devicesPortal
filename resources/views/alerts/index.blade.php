@extends('layout')

@section('header') Alerts @endsection

@section('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Site</th>
        <th>Assigned To</th>
        <th>Action</th>
    </tr>
    @forelse ($alerts as $alert)
    <tr>
        <td class="tbl-index">{{ $alert->id }}</td>
        <td class="tbl-index">{{ $alert->title }}</td>
        <td class="tbl-index">{{ $alert->device->site->name }}</td>
        <td class="tbl-index">{{ $alert->user->name }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/alerts/{{ $alert->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/alerts/{{ $alert->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @empty
    </table>

    <div class="h5 mx-2 text-center"> You have no active Alerts...</div>
    @endforelse
</table>
@endsection