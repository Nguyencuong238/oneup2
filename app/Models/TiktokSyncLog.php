<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokSyncLog extends Model
{
    protected $fillable = [
        'kol_id',
        'followers',
        'likes_count',
        'comments_count',
        'shares_count',
        'videos_count',
        'error_message',
        'recorded_date',
    ];

    protected $casts = [
        'error_message' => 'string',
    ];

    public function kol()
    {
        return $this->belongsTo(Kol::class);
    }
}
