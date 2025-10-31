<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolFavorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kol_id'];

    public function kol()
    {
        return $this->belongsTo(Kol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
