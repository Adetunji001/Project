<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 
        'todo_id',
        'todo',
         
    ];

    public function todo(){
        return $this->belongsTo(Todo::class, 'todo_id', 'id');
    }
}
