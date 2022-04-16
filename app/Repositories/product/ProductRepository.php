<?php

namespace App\Repositories\product;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Requests\StoreProductRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository
{
    public function getModel(): Product
    {
        return new Product();
    }

    public function getAllProductAdmin(Request $request): LengthAwarePaginator
    {
        //dd($request->all());
        if (empty($request->all())) {
            return $this->getModel()->withTrashed('images', 'category')
                ->orderBy('name')->paginate(env('PAGINATE'));
        } else {
            $isInactive = $request->get('searchbyisInactive');

            $category = $request->get('searchbycategory');

            return $this->getModel()->withTrashed('images', 'category')
                ->isinactive($isInactive)->category($category)->orderBy('name')->paginate(env('PAGINATE'));
        }
    }

    public function createProduct(Request $data): RedirectResponse
    {
        $urlimages = [];
        if ($data->hasFile('images')) {
            $images = $data->file('images');

            foreach ($images as $image) {
                $name = time() . '_' . $image->getClientOriginalName();

                $route = public_path() . '/images/products';

                $image->move($route, $name);

                $urlimages[]['url'] = '/images/products/' . $name;
            }
        }

        //$prod = $this->getModel();
        $prod = new Product();

        $prod->name = $data->name;
        $prod->category_id = $data->category_id;
        $prod->quantity = $data->quantity;
        $prod->price = $data->price;
        $prod->description = $data->description;
        $prod->status = $data->status;

        $prod->save();

        $prod->images()->createMany($urlimages);

        Log::channel('contlog')->info('The product: ' .
            $prod->name . ' has been created by: ' . ' ' .
            Auth::user()->name . ' ' . Auth::user()->surname);

        return redirect()->route('admin.product.index');
    }

    public function getProductbyId(int $id): Model
    {
        return $this->getModel()->with('images', 'category')
            ->where('id', $id)->firstOrFail();
    }

    public function updateProduct(Request $data, string $id): void
    {
        $urlimages = [];
        if ($data->hasFile('images')) {
            $images = $data->file('images');

            foreach ($images as $image) {
                $name = time() . '_' . $image->getClientOriginalName();

                $route = public_path() . '/images/products';

                $image->move($route, $name);

                $urlimages[]['url'] = '/images/products/' . $name;
            }
        }
        $category = Category::where('name', $data->category_id)->first();


        $prod = $this->getModel()->findOrFail($id);

        $prod->name = $data->name;
        $prod->category_id = $category->id;
        $prod->quantity = $data->quantity;
        $prod->price = $data->price;
        $prod->description = $data->description;
        $prod->status = $data->status;

        $prod->save();


        $prod->images()->createMany($urlimages);

        Log::channel('contlog')->info('El producto: ' .
            $prod->name . ' ' . 'ha sido editado por: ' . ' ' .
            Auth::user()->name . ' ' . Auth::user()->surname);
    }

    public function categoryForProduct(): Collection
    {
        return Category::cachedCategories();
    }
}