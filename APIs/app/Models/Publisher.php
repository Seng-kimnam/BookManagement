<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    // Mass-assignable fields
    protected $fillable = ['name', 'address', 'phone', 'email'];

    // Define relationship with Book
    public function books()
    {
        return $this->hasMany(Book::class, 'publisherid');
    }
}
