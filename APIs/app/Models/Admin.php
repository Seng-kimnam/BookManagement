<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['name', 'email', 'password'];

    // Relationship with Transaction
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'adminid');
    }
}
