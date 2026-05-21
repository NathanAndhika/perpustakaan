<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class borrowings extends Model
{
    protected $fillable = [
    'user_id',
    'book_id',
    'nama_peminjam',
    'tanggal_peminjam',
    'tanggal_pengembalian',
    'status'
];

        public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
