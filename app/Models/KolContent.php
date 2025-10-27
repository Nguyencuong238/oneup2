<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolContent extends Model
{
    use HasFactory;

    protected $table = 'kol_content';

    protected $fillable = [
        'kol_id',
        'platform_post_id',
        'content_type',
        'title',
        'description',
        'hashtags',
        'thumbnail_url',
        'video_url',
        'duration_seconds',
        'posted_at',
        'likes_count',
        'comments_count',
        'shares_count',
        'views_count',
        'completion_rate',
        'engagement_rate',
        'is_sponsored',
        'brand_mentioned',
    ];

    protected $casts = [
        'hashtags' => 'array',
        'posted_at' => 'datetime',
        'completion_rate' => 'decimal:2',
        'engagement_rate' => 'decimal:2',
        'is_sponsored' => 'boolean',
    ];

    // Quan hệ với bảng KOL
    public function kol()
    {
        return $this->belongsTo(Kol::class);
    }
}
