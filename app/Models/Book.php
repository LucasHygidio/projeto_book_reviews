<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'summary', 'genre_id', 'author_id'
    ];

    public function reviews(){
        return $this-> hasMany(Review::class);
    }

    public function genre(){
        return $this -> belongsTo(Genre::class);
    }

    public function author(){
        return $this -> belongsTo(Author::class);
    }
}
