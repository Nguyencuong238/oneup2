<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolBooking extends Model
{
    use HasFactory;

    protected $table = 'kol_booking';

    protected $fillable = [
        'user_id',
        'kol_id',
        'service_id',
        'note',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(KolService::class);
    }

    public function kol()
    {
        return $this->belongsTo(Kol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
