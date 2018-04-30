<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'category_id',
    ];

    /* id o'rniga slug orqali parametr qabul qilish uchun*/
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*Slug ustuniga post title yozish*/
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function photos()
    {
        return $this->hasMany(PostPhoto::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
