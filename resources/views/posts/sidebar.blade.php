<h5 class="card-header">Categories</h5>
<div class="card-body">
    <div class="row">
        @foreach($categories as $category)
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @foreach($category as $item)
                        <li>
                            <a href="{{route('posts.index', ['category'=>$item])}}">{{$item->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>