<?php

namespace App\Models\Concerns;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InvalidArgumentException;

trait HasTags
{
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(Tag::class, 'taggable');
    }

    public function scopeWithAnyTags(
        Builder $query,
        $tags,
        string $type = null,
    ): Builder {
        $tags = static::convertToTags($tags, $type);

        return $query
            ->whereHas('tags', function (Builder $query) use ($tags) {
                $tagIds = collect($tags)->pluck('id');

                $query->whereIn('tags.id', $tagIds);
            });
    }

    protected static function convertToTags($values, $type = null)
    {
        if ($values instanceof Tag) {
            $values = [$values];
        }

        return collect($values)->map(function ($value) use ($type) {
            if ($value instanceof Tag) {
                if (isset($type) && $value->type != $type) {
                    throw new InvalidArgumentException("Type was set to {$type} but tag is of type {$value->type}");
                }

                return $value;
            }

            return Tag::findFromString($value, $type);
        });
    }

    public function attachTags($tags, string $type = null): static
    {
        $tags = collect(Tag::findOrCreate($tags, $type));

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        return $this;
    }

    public function attachTag($tag, string $type = null)
    {
        return $this->attachTags([$tag], $type);
    }

    public function detachTags($tags, string $type = null): static
    {
        $tags = static::convertToTags($tags, $type);

        collect($tags)
            ->filter()
            ->each(fn (Tag $tag) => $this->tags()->detach($tag));

        return $this;
    }

    public function detachTag($tag, string $type = null): static
    {
        return $this->detachTags([$tag], $type);
    }

    public function syncTags($tags): static
    {
        $tags = collect(Tag::findOrCreate($tags));

        $this->tags()->sync($tags->pluck('id')->toArray());

        return $this;
    }

    public function syncTagsWithType($tags, string $type = null): static
    {
        $tags = collect(Tag::findOrCreate($tags, $type));

        $this->syncTagIds($tags->pluck('id')->toArray(), $type);

        return $this;
    }

    protected function syncTagIds($ids, string $type = null, $detaching = true): void
    {
        $isUpdated = false;

        // Get a list of tag_ids for all current tags
        $current = $this->tags()
            ->newPivotStatement()
            ->where('taggable_id', $this->getKey())
            ->where('taggable_type', $this->getMorphClass())
            ->when($type !== null, function ($query) use ($type) {
                $tagModel = $this->tags()->getRelated();

                return $query->join(
                    $tagModel->getTable(),
                    'taggables.tag_id',
                    '=',
                    $tagModel->getTable() . '.' . $tagModel->getKeyName()
                )
                    ->where($tagModel->getTable() . '.type', $type);
            })
            ->pluck('tag_id')
            ->all();

        // Compare to the list of ids given to find the tags to remove
        $detach = array_diff($current, $ids);
        if ($detaching && count($detach) > 0) {
            $this->tags()->detach($detach);
            $isUpdated = true;
        }

        // Attach any new ids
        $attach = array_unique(array_diff($ids, $current));
        if (count($attach) > 0) {
            collect($attach)->each(function ($id) {
                $this->tags()->attach($id, []);
            });
            $isUpdated = true;
        }

        // Once we have finished attaching or detaching the records, we will see if we
        // have done any attaching or detaching, and if we have we will touch these
        // relationships if they are configured to touch on any database updates.
        if ($isUpdated) {
            $this->tags()->touchIfTouching();
        }
    }
}
