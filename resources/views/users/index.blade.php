@extends('layout')

@section('header') Users @endsection

@section ('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    @foreach ($users as $user)
    @if($user->role->title != "super")
    <tr>
        <td class="tbl-index">{{ $user->id }}</td>
        <td class="tbl-index">{{ $user->name }}</td>
        <td class="tbl-index">{{ $user->email }}</td>
        <td class="tbl-index">{{ $user->role->title }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/users/{{ $user->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endif
    @endforeach
</table>
@endsection