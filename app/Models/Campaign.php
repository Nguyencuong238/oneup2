<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Many-to-many relationship with Kol
    public function kols()
    {
        return $this->belongsToMany(Kol::class, 'campaign_kols', 'campaign_id', 'kol_id');
    }
}
