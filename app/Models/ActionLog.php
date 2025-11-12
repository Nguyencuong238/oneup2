<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionLog extends Model
{
    use HasFactory;

    protected $table = 'action_logs';

    protected $fillable = [
        'user_id',
        'action',
        'record_at',
    ];

    public $timestamps = false; // vì ta dùng record_at thay cho created_at

    protected $casts = [
        'record_at' => 'datetime',
    ];

    // Liên kết tới model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
