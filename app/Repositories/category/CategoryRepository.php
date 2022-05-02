<?php

namespace App\Repositories\category;

use App\Exports\CategoriesExport;
use App\Helpers\Paginator;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CategoryRepository extends BaseRepository
{
    public function getModel(): Category
    {
        return new Category();
    }

    public function findCategory(string $id): Model
    {
        return $this->getModel()->where('id', $id)->firstOrFail();
    }

    public function getAllCategories(Request $request)
    {
        return Paginator::paginate($request, Category::cachedCategories());
    }

    public function createCategory(array $data): Model
    {
        Category::flushCache();

        return $this->getModel()->create($data);
    }

    public function updateCategory(object $object, array $data): object
    {
        $object->fill($data);
        $object->save();
        Category::flushCache();
        Log::channel('contlog')->info('The category: ' . $object->name . ' ' . 'has been updated by: ' . ' ' . Auth::user()->name . ' ' . Auth::user()->surname);

        return $object;
    }

    public function categoriesExport(): BinaryFileResponse
    {
        return (new CategoriesExport())->download('categories.xlsx');
    }
}
