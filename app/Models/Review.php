<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    public static function rating($id)
    {
        // $reviews = Review::where('event_id', $id)->get();
        // $sum = 0;
        // $count = 0;
        // foreach ($reviews as $review) {
        //     $sum += $review->rating;
        //     $count = $count + 1;
        // }
        // return $sum/$count;
    }
}
