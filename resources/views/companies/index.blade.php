@extends('layout')

@section('header') Companies @endsection

@section ('content')
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    @foreach ($companies as $company)
    <tr>
        <td class="tbl-index">{{ $company->id }}</td>
        <td class="tbl-index">{{ $company->name }}</td>
        <div class="btn-group form-inline pull-left">
            <td class="tbl-index">
                <a href="/companies/{{ $company->id }}" class="btn btn-secondary btn-sm" type="submit">View</a>
                @if($rName === "super" || $rName === "admin")
                <a href="/companies/{{ $company->id }}/edit" class="btn btn-primary btn-sm" type="submit">Edit</a>
                @endif
            </td>
        </div>
    </tr>
    @endforeach
</table>
@endsection