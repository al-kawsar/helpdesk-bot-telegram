<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubKategori extends Model
{
    use HasFactory;
    protected $fillable = ['sub_sub_kategori', 'sub_kategori_id'];

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class); // Tambahkan return
    }

    public function Pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
