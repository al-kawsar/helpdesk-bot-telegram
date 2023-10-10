<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kategori', 'id_grup'];

    public function grup()
    {
        return $this->belongsTo(Group::class, 'id_grup', 'id_grup');
    }

    public function subKategori()
    {
        return $this->hasMany(SubKategori::class, 'kategori_id');
    }
}
