<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\category;
use App\Models\Image;
use App\Models\Detail;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
        [
            'name', 'category_id','quantity','price',
            'description', 'status'
        ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

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