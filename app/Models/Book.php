<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns'   => [
            'books.title'       => 10,
            'books.description' => 10,
            'u.name'    => 10,
        ],
        'joins' => [
            'users as u' => ['books.user_id', 'u.id']
        ],
        'groupBy' => 'books.id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_book');
    }


    // Likes
    public function likes()
    {
        return $this->hasMany(LikeDislike::class, 'book_id')->sum('like');
    }
    // Dislikes
    public function dislikes()
    {
        return $this->hasMany(LikeDislike::class, 'book_id')->sum('dislike');
    }
}
