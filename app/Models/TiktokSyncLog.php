<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokSyncLog extends Model
{
    protected $fillable = [
        'started_at',
        'finished_at',
        'total_kols',
        'success_count',
        'failed_count',
        'error_messages',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'error_messages' => 'array',
    ];
}
