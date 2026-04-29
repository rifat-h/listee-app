<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug',
        'description', 'price', 'location', 'image', 'gallery',
        'phone', 'email', 'website', 'latitude', 'longitude',
        'status', 'is_featured', 'views', 'expires_at',
    ];

    protected $casts = [
        'gallery' => 'array',
        'expires_at' => 'datetime',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}