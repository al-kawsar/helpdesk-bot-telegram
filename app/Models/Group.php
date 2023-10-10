<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }

    public function bot()
    {
        return $this->hasMany(Bot::class, 'id');
    }
}
