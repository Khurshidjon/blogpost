<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostRequest;
use App\Post;
use App\PostPhoto;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
       //// $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return view('categ_post', ['category'=>$category]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $post->body = $request->body;
        $post->user_id = \Auth::user()->id;
        $post->category_id = $request->get('category');
        $post->page_view = '0';
        $post->save();
        foreach ($request->photos as $item) {
            $filename = $item->store('image');
            PostPhoto::create([
                'filename'=>$filename,
                'post_id'=>$post->id,
            ]);
        }
        return redirect()->route('home')->with('info', 'Post created successfully!');
    }

    public function categForm()
    {
        return view('posts.addCategory');
    }

    public function AddCategory(Request $request)
    {
        $request->validate(['name'=>'required']);
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect()->route('create.form');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('page_view');
        $post->page_view += 1;
        return view('posts.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', ['post'=>$post, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, PostPhoto $photo)
    {
        $this->authorize('update', $post);

        $post->update(
            [
                'title'=>$request->title,
                'slug'=>SlugService::createSlug(Post::class, 'slug', $request->title),
                'body'=>$request->body,
                'user_id'=>$post->user->id,
                'category_id'=>$request->get('category'),
                'page_view'=>$post->page_view,
            ]
        );
        foreach ($request->photos as $item) {
            $filename = $item->store('image');
            $photo->update([
                'filename'=>$filename,
                'post_id'=>$post->id,
            ]);
        }
        return redirect()->route('home')->with('info', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back()->with('info', 'Post deleted successfully!');
    }

    public function commentDelete(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back();
    }
    public function createComment(Post $post, Request $request)
    {
        $request->validate([
            'add_comment'=>'required'
        ]);
        $comm = new Comment;
        $comm->comments = $request->add_comment;
        $comm->user_id = Auth::user()->id;
        $comm->post_id = $post->id;
        $comm->save();
        return redirect()->back();
    }
    public function editComment(Comment $comment, Post $post)
    {
        return view('posts.commentEdit', ['comment'=>$comment, 'post'=>$post]);
    }
    public function updateComment(Post $post, Comment $comment, Request $request)
    {
        $request->validate(['update_comment'=>'required']);
        $this->authorize('update', $comment);
        $comment->update([
            'comments'=>$request->update_comment,
            'user_id'=>$comment->user->id,
            'post_id'=>$post->id,
        ]);
        return redirect()->route('posts.show', ['post'=>$post])->with('info', 'Your comment update successfully!');
    }
}
