@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">The Uzbekistan Times
                </h1>

                <!-- Blog Post -->
                <div class="card mb-4">
                    @foreach($category->posts as $post)
                        @foreach($post->photos as $photo)
                            <img class="card-img-top img-thumbnail" src="{{asset('image')}}/{{$photo->filename}}" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title">{{$post->title}}</h2>
                                <small class="text-info mx-4">{{date_format($post->created_at, "H:i m.d.Y")}}</small>
                                <small class="text-dark"><i class="fa fa-eye"></i> {{$post->page_view}}</small>
                                <small class="ml-4 text-danger"><i class="fa fa-certificate"></i> {{$post->category->name}}</small>
                                <p class="card-text">{{str_limit($post->body, 100)}}</p>
                                <a href="{{route('posts.show', ['post'=>$post])}}" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="card-footer text-muted">
                        Posted on January 1, 2017 by
                        <a href="#">Start Bootstrap</a>
                    </div>
                </div>

                <ul class="pagination justify-content-center mb-4">
                    <!-- Pagination -->
                </ul>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    @include('posts.sidebar')
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
@endsection
