<?php

namespace App\Repositories\category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Helpers\Paginator;

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
        /*$name = $data->get('name');

        return $this->getModel()->withTrashed('category')
            ->where('name', 'like', "%$name%")->orderBy('name')->paginate(1);*/

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
        Log::channel('contlog')->info('La categoria: ' .
            $object->name . ' ' . 'ha sido editada por: ' . ' ' .
            Auth::user()->name . ' ' . Auth::user()->surname);

        return $object;
    }
}
