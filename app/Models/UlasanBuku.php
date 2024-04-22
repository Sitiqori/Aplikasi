<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UlasanBuku extends Model
{
    use HasFactory;
    protected $table = 'ulasan_buku';
    protected $fillable = [
        'user_id',
        'book_id',
        'ulasan',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',  'id');
    }


    public function book()
{
    return $this->belongsTo(Book::class, 'books_id', 'id');
}

}
