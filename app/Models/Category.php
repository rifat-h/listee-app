<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'image', 'description', 'color', 'parent_id', 'is_active', 'order'];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}