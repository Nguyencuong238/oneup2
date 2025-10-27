<?php

namespace App\Models;

use App\Models\Concerns\HasCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Kol extends Model implements HasMedia
{
    use HasFactory;
    use HasCategories;
    use InteractsWithMedia;

     protected $fillable = [
        'platform_id',
        'username',
        'display_name',
        'bio',
        'location_country',
        'location_city',
        'language',
        'is_verified',
        'tier',
        'status',
        'engagement',
        'followers',
        'trust_score',
        'price',
    ];

    public function getInitialsAttribute()
    {
        $name = $this->display_name;
        $words = preg_split('/\s+/', trim($name));

        $initials = collect($words)
            ->filter()
            ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
            ->join('');

        return $initials;
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this
        ->addMediaCollection('media')
        ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this
            ->addMediaConversion('show')
            ->fit(Manipulations::FIT_CROP, 310, 300)
            ->format('webp')
            ->nonQueued();

        $this
            ->addMediaConversion('show-bf')
            ->fit(Manipulations::FIT_CROP, 315, 200)
            ->format('webp')
            ->nonQueued();
    }



    /**
     * The campaigns this KOL is attached to.
     *
     * Assumes a pivot table named `campaign_kols` with optional metric columns
     * like `views`, `conversions`, `content_posted`, `engagement` and timestamps.
     */
    public function campaigns()
    {
        return $this->belongsToMany(\App\Models\Campaign::class, 'campaign_kols', 'kol_id', 'campaign_id')
                    //->withPivot(['views', 'conversions', 'content_posted', 'engagement'])
                    //->withTimestamps()
                    ;
    }

    public function stats()
    {
        return $this->hasMany(KolStat::class);
    }

    public function contents()
    {
        return $this->hasMany(KolContent::class);
    }

}
