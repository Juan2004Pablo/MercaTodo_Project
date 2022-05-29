<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseRepository
{
    abstract public function getModel();

    public function findId(int $id): Model
    {
        return $this->getModel()->find($id);
    }

    public function getAllProduct(Request $request): LengthAwarePaginator
    {
        $name = $request->get('searchbyname');
        $price = $request->get('searchbyprice');
        $category = $request->get('searchbycategory');

        return $this->getModel()->withTrashed('images', 'category')
            ->name($name)->price($price)->category($category)->orderBy('name')->paginate(env('PAGINATE'));
    }

    public function getAllProductHome(Request $request): LengthAwarePaginator
    {
        $name = $request->get('searchbyname');
        $price = $request->get('searchbyprice');
        $category = $request->get('searchbycategory');

        return $this->getModel()->with('images', 'category')
            ->name($name)->price($price)->category($category)->orderBy('name')->paginate(env('PAGINATE'));
    }

    public function getProductsOfCart()
    {
        return $this->getModel()->with('details.products', 'details.products.images')
            ->pending()->first();
    }

    public function delete(object $object)
    {
        $object->delete();
        Category::flushCache();
    }

    public function restore(Request $data): bool
    {
        Category::flushCache();

        return $this->getModel()->withTrashed()->find($data->id)->restore();
    }
}
