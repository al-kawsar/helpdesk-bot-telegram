<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'first_name',
        'id_bot',
        'apikey',
        'username',
        'status'
    ];
    protected $table = 'bots';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function grup()
    {
        return $this->hasMany(Group::class, 'bot_id');
    }
}
