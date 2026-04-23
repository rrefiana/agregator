<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'link',
        'author',
        'kategori',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];

    /**
     * Scope untuk berita yang sudah dipublikasikan
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('tanggal_publish');
    }

    /**
     * Scope untuk berita berdasarkan kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Accessor untuk mendapatkan tanggal publish yang diformat
     */
    public function getTanggalPublishFormattedAttribute()
    {
        return $this->tanggal_publish ? $this->tanggal_publish->format('d M Y H:i') : null;
    }

    /**
     * Mutator untuk mengatur judul dengan kapitalisasi
     */
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords(strtolower($value));
    }
}