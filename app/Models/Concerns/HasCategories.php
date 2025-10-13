<?php

namespace App\Models\Concerns;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InvalidArgumentException;

trait HasCategories
{
    public function categories(): MorphToMany
    {
        return $this
            ->morphToMany(Category::class, 'categoryable');
    }

    public function scopeWithAnyCategories(
        Builder $query,
        $categories,
        string $type = null,
    ): Builder {
        $categories = static::convertToCategories($categories, $type);

        return $query
            ->whereHas('categories', function (Builder $query) use ($categories) {
                $categoryIds = collect($categories)->pluck('id');

                $query->whereIn('categories.id', $categoryIds);
            });
    }

    protected static function convertCategories($values, $type = null)
    {
        if ($values instanceof Category) {
            $values = [$values];
        }

        return collect($values)->map(function ($value) use ($type) {
            if ($value instanceof Category) {
                if (isset($type) && $value->type != $type) {
                    throw new InvalidArgumentException("Type was set to {$type} but category is of type {$value->type}");
                }

                return $value;
            }

            return Category::findFromString($value, $type);
        });
    }

    public function attachCategories($categories, string $type = null): static
    {
        $categories = collect(Category::findOrCreate($categories, $type));

        $this->categories()->syncWithoutDetaching($categories->pluck('id')->toArray());

        return $this;
    }

    public function attachCategory($category, string $type = null)
    {
        return $this->attachCategorys([$category], $type);
    }

    public function detachCategories($categories, string $type = null): static
    {
        $categories = static::convertToCategories($categories, $type);

        collect($categories)
            ->filter()
            ->each(fn (Category $category) => $this->categories()->detach($category));

        return $this;
    }

    public function detachCategory($category, string $type = null): static
    {
        return $this->detachCategories([$category], $type);
    }

    public function syncCategories($categories): static
    {
        $categories = collect(Category::findOrCreate($categories));

        $this->categories()->sync($categories->pluck('id')->toArray());

        return $this;
    }
}
