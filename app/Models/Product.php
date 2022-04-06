<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\category;
use App\Models\Image;
use App\Models\Detail;

class Product extends Model
{
    use HasFactory;

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /*public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }*/

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    public function scopePrice($query, $price)
    {
        if ($price) {
            return $query->where('price', '>=', "$price");
        }
    }

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'like', "%$name%");
        }
    }

    public function scopeCategory($query, $category)
    {
        if ($category) {
                 return $query->where('category_id', 'like', "%$category%");
        }
    }
}