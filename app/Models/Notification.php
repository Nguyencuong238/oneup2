<?php

namespace App\Models;

use App\Models\Concerns\HasCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    use HasCategories;

    protected $table = 'notifications';

    public $guarded = [''];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function showUrl()
    {
        return route('front.notifications.show', ['id' => $this->id, 'slug' => $this->slug]);
    }

    public function scopeForCard($query)
    {
        $query->select('id', 'title', 'link', 'status');
    }
}
