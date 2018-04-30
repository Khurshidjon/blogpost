@extends('layouts.app')

@section('content')
    <div class="container">
    @if(session('info'))
    <div class="alert alert-danger text-center">{{session('info')}}</div>
    @endif
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">The Uzbekistan Times
                </h1>

                <!-- Blog Post -->
            @foreach($posts as $post)
                <div class="card mb-4">
                        @foreach($post->photos as $photo)
                    <img class="card-img-top img-thumbnail" src="{{asset('image').'/'.$photo->filename}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{$post->title}}</h2>
                            <small class="text-info mx-4"><i class="fa fa-clock-o"></i> {{date_format($post->created_at, "H:i m.d.Y")}}</small>
                            <small class="text-dark"><i class="fa fa-eye"></i> {{$post->page_view}}</small>
                            <small class="ml-4 text-danger"><i class="fa fa-certificate"></i> {{$post->category->name}}</small>
                            <p class="card-text">{{str_limit($post->body, 100)}}</p>
                        <!--Only admin can edit-->
                        @can('update', $post)
                            <a href="{{route('post.edit', ['post'=>$post])}}" class="btn btn-outline-light"><i class="fa fa-edit text-success"></i></a>
                        @endcan
                        <!--Only admin can delete-->
                        @can('delete', $post)
                            <form class="d-inline" method="post" action="{{route('post.delete', ['post'=>$post])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-light"><i class="fa fa-trash text-danger"></i></button>
                            </form>
                        @endcan
                    </div>
                         @endforeach
                        <a href="{{route('posts.show', ['post'=>$post])}}" class="btn btn-primary mb-2">Read More &rarr;</a>
                </div>
            @endforeach

                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item">
                        {{$posts->links()}}
                    </li>
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
