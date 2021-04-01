@extends('layout')

@section('header') Sites @endsection

@section('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Company</th>
        <th>Action</th>
    </tr>
    @foreach ($sites as $site)
    <tr>
        <td class="tbl-index">{{ $site->id }}</td>
        <td class="tbl-index">{{ $site->name }}</td>
        <td class="tbl-index">@if(!$site->company) N/A @else {{ $site->company->name }} @endif</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/sites/{{ $site->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/sites/{{ $site->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endforeach
</table>
@endsection