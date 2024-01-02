<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 
        'admin_id',
        'title',
        'description', 
        'post_body',
        'slug',
        'image',
        'post',
    ];   

    public function click(){
        return $this->hasMany(Click::class, 'click_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'comment_id', 'id');
    }

    public function likes(){
        return $this->hasMany(Likes::class, 'likes_id', 'id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
