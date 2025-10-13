<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    use HasRecursiveRelationships;

    protected $casts = [
        'meta' => 'array',
    ];

    public static function findFromString(string $name, string $type = null)
    {
        return static::query()
            ->where('name', $name)
            ->where('type', $type)
            ->first();
    }

    protected static function findOrCreateFromString(string $name, string $type = null)
    {
        $tag = static::findFromString($name, $type);

        if (! $tag) {
            $tag = static::create([
                'name' => $name,
                'type' => $type,
            ]);
        }

        return $tag;
    }

    //    public static function findOrCreate(
    //        $values,
    //        string $type = null,
    //    ) {
    //        $tags = collect($values)->map(function ($value) use ($type) {
    //            if ($value instanceof self) {
    //                return $value;
    //            }
    //
    //            return static::findOrCreateFromString($value, $type);
    //        });
    //
    //        return is_string($values) ? $tags->first() : $tags;
    //    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function scopeOnlyRoot(Builder $query)
    {
        return $query->whereNull('parent_id');
    }

    public function selectText(): string
    {
        $prettyName = '';
        if ($this->ancestors->isNotEmpty()) {
            foreach ($this->ancestors as $ancestor) {
                $prettyName .= '¦&nbsp;&nbsp;&nbsp;&nbsp;';
            }
        }
        $prettyName .= $this->name;

        if ($this->parent == null) {
            $typeMapping = [
                'post' => 'Bài viết',
                'project' => 'Dự án',
                'event' => 'Sự kiện',
                'image' => 'Ảnh',
                'video' => 'Video',
            ];

            $prettyName .= ' <b>(' . @$typeMapping[$this->type] . ')</b>';
        }

        return $prettyName;
    }

    public function childs()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function categoryables()
    {
        return $this->morphTo();
    }

    public function getName(): string
    {
        $prettyName = '';
        if ($this->ancestors->isNotEmpty()) {
            foreach ($this->ancestors as $ancestor) {
                $prettyName .= '¦&nbsp;&nbsp;&nbsp;&nbsp;';
            }
        }
        $prettyName .= $this->name;
        return $prettyName;
    }

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'categoryable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categoryable');
    }
}
