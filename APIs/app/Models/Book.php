<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'image',
        'publisherid',
        'categoryid',
        'published_year',
        'quantity',
        'price'
    ];

    // Relationship with Publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisherid');
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    // Relationship with Transaction
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'bookid');
    }
    public function authorbook()
    {
        return $this->hasMany(AuthorBook::class, 'bookid');
    }
}
