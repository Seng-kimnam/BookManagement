<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['adminid', 'bookid', 'quantity', 'transaction_date'];

    // Relationship with Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'adminid');
    }

    // Relationship with Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'bookid'); 
    }
}
