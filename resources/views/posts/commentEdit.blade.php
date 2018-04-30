@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="my-4 text-secondary">Welcome {{$comment->user->name}}, here you can update your comment</h1>
        <form action="{{route('comment.update', ['post'=>$post, 'comment'=>$comment])}}" method="post" class="w-50 my-5">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comm"></label>
                <textarea id="comm" name="update_comment" class="form-control {{ $errors->has('update_comment') ? ' is-invalid' : '' }}" rows="3">{{$comment->comments}}</textarea>
            </div>
            @if ($errors->has('update_comment'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('update_comment') }}</strong>
                </span>
            @endif
            <input type="submit" value="Update comment" class="btn btn-success mb-5">
        </form>
    </div>
@endsection
