<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KolStat extends Model
{
    protected $table = 'kol_stats';
    protected $fillable = [
        'kol_id', 'followers_count', 'following_count', 'total_posts',
        'total_likes', 'total_comments', 'total_shares', 'total_views',
        'avg_engagement_rate', 'avg_likes_per_post', 'avg_comments_per_post',
        'avg_shares_per_post', 'avg_views_per_post', 'avg_completion_rate',
        'posts_per_week', 'recorded_at'
    ];
}
