@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <h1 class="text-primary text-center">Welcome our Admin, do you want to edit your Post?</h1>
        <div>
            <button type="button" class="btn btn-info my-5 btn-block" data-toggle="modal" data-target="#edit-Post">Update Post</button>
        </div>
        <div class="modal fade" id="edit-Post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Welcome {{Auth::user()->name}}</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Post category: {{$post->category->name}}</p>
                        <form action="{{route('post.update', ['post'=>$post])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input id="title" type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{$post->title, old('title')}}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea id="body" name="body" rows="5" class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}">{{$post->body, old('body')}}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="file" name="photos[]" class="form-control"  multiple>
                            </div>
                            <input type="submit" value="Update Post" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection