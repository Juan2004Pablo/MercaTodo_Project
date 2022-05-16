<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function cachedCategories()
    {
        return Cache::rememberForever('categories', function () {
            return self::withTrashed('category')->select('id', 'name', 'description')->orderBy('id', 'Asc')->get();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('categories');
    }
}
