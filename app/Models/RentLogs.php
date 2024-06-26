<?php

namespace App\Models;

use App\Models\UlasanBuku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentLogs extends Model
{
    use HasFactory;
    protected $table = 'rent_logs';
    protected $fillable = [
        'book_id',
        'user_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'tanggal_harus_dikembalikan',
        'status_peminjaman'
    ];

    //id nya milik user
    //user_id milik rentlog

    // return $this->hasOne(User::class, 'id',  'user_id');
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',  'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function ulasanBuku()
{
    return $this->hasOne(UlasanBuku::class, 'rent_log_id', 'id');
}

}
