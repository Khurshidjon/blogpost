<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comments', 'user_id', 'post_id'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
