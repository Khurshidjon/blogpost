@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-primary text-center">Welcome our Admin, do you want to add new Category?</h1>

        <div>
            <button type="button" class="btn btn-info my-5 btn-block" data-toggle="modal" data-target="#create-category">Add Category</button>
        </div>
        <div class="modal fade" id="create-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Welcome {{Auth::user()->name}}</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <form data-toggle="validator" action="{{route('add.category')}}" method="post">
                            @csrf
                            <div class="form-group mt-5">
                                <label for="categories">New Category</label>
                                <input type="text" id="categories" class="form-control" name="name">
                            </div>
                            <input type="submit" value="Add category" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection