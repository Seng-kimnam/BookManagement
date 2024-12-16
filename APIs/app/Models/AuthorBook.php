<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $fillable = ['authorid', 'bookid'];
    public function author()
    {
        return $this->belongsTo(Author::class, "authorid");
    }
    public function book()
    {
        return $this->belongsTo(Book::class, "bookid");
    }
}
