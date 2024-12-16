<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mass-assignable fields
    protected $fillable = ['name'];

    // Define relationship with Book
    public function books()
    {
        return $this->hasMany(Book::class, 'categoryid');
    }
}