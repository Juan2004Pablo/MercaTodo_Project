<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function cachedCategories()
    {
        return Cache::rememberForever('categories', function () {

            return Category::withTrashed('category')->select('id', 'name', 'description')
                ->orderBy('name')->get();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('categories');
    }

    /*
    /**
     * Softdelete category.
     *
     * @var string[]
     *
    protected $dates = ['deleted_at'];
    */
}
