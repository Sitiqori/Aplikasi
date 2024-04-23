<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiPribadi extends Model
{
    use HasFactory;

    
    protected $table = 'kolesipribadi';

    protected $fillable = [
        'user_id',
        'books_id'
    ];
}
