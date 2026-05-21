<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'deskripsi',
        'cover_buku',
        'file_pdf'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function readingHistories()
    {
        return $this->hasMany(ReadingHistory::class);
    }
}
