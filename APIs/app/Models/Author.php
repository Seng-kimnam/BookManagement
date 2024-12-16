<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable =[ 'name'];

    public function authorbook(){
        
        return $this->hasMany(AuthorBook::class, 'authorid');
    }
    
}
