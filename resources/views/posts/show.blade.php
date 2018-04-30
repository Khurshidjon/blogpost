@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('info'))
            <div class="alert alert-danger">
                {{session('info')}}
            </div>
        @endif
    <div class="card mb-4">
    @foreach($post->photos as $photo)
        <img class="card-img-top mx-auto img img-thumbnail w-75" src="{{asset('image').'/'.$photo->filename}}" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <small class="text-info">{{date_format($post->created_at, "H:i m.d.Y")}}</small>
            15 <i class="fa fa-thumbs-o-up mr-4"></i>
            10 <i class="fa fa-thumbs-o-down"></i>
            <p class="card-text">{{$post->body}}</p>
        </div>
    @endforeach
    </div>
        <div class="row">
            <div class="col-lg-6 my-5">
                <h2 class="text-secondary">Comments</h2>
                <hr>
                @foreach($post->comments as $comment)
                    <div class="card">
                            <div class="card-header">
                                <img src="" class="card-img-top border-dark"><p class="my-0">{{$comment->user->name}}</p>
                            </div>
                            <div class="card-body">
                                <p class="text-secondary">{{$comment->comments}} <sub>{{date_format($comment->created_at, 'H:i')}}</sub></p>
                            </div>
                            <div class="card-footer">
                                @can('update', $comment)
                                    <a href="{{route('comment.edit', ['comment'=>$comment, 'post'=>$post])}}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('delete', $comment)
                                    <form action="{{route('comment.delete', ['comment'=>$comment])}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-light"><i class="fa fa-trash-o text-danger"></i></button>
                                    </form>
                                @endcan
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
            @if(Auth::user())
                <form action="{{route('comment.create', ['post'=>$post])}}" method="post" class="w-50">
                    @csrf
                    <div class="form-group">
                        <label for="comm"></label>
                        <textarea id="comm" name="add_comment" class="form-control" rows="3"></textarea>
                    </div>
                    <input type="submit" value="Comment" class="btn btn-success mb-5">
                </form>
            @endif
    </div>
@endsection