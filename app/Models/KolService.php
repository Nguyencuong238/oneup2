<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolService extends Model
{
    use HasFactory;

    protected $table = 'kol_services';

    protected $fillable = [
        'kol_id',
        'name',
        'image',
        'price',
        'description',
    ];

    public function kol()
    {
        return $this->belongsTo(Kol::class);
    }
}
