<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'food_item_id',
        'user_id',
        'rating',
        'review'
    ];

    public function food()
    {
        return $this->belongsTo(FoodItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}