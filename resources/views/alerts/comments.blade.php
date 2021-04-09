@extends('layout')

@section('header') {{ $alert->title }} - Comments @endsection

@section('content')
    <div class="btn-toolbar">
        <form method="GET" action="/alerts/{{ $alert->id }}">
            @csrf
            <button class="btn btn-secondary mx-2 mb-3" type="submit">Back</button>
        </form>
        <form>
            <button class="btn btn-warning mx-2 margin-bottom" type="button" data-toggle="modal" data-target="#exampleModal">Add Comment</button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/alerts/{{ $alert->id }}/comments">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label" for="message">Comment</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" type="text" name="message" id="message" value="{{ old('message') }}"></textarea>
                        @error('message')
                            <p class="text-danger">{{ $errors->first('message') }}</p>
                        @enderror  
                </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
         </div>
        </div>
        </div>

    
    </div>

@forelse($comments as $comment)

<div class="col-md-12 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        {{ $comment->user->name }} - {{ $comment->created_at }}
                    </div>
                    <div class="h8 mb-0 text-gray-800">
                        {{ $comment->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@empty

<div class="col-md-12 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                    <div class="h5 mb-0 font-weight-bold text-center text-gray-800">
                        No comments here yet!
                    </div>
            </div>
        </div>
    </div>
</div>


@endforelse


@endsection