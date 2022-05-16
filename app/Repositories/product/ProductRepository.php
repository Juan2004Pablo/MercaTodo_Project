<?php

namespace App\Repositories\product;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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
        if (empty($request->all())) {
            return $this->getModel()->withTrashed('images', 'category')->orderBy('id')->paginate(env('PAGINATE'));
        } else {
            $category = $request->get('searchbycategory');

            return $this->getModel()->withTrashed('images', 'category')->category($category)->orderBy('id')->paginate(env('PAGINATE'));
        }
    }

    public function createProduct(Request $data): void
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

            $prod = new Product();

            $prod->name = $data->name;
            $prod->category_id = $data->category_id;
            $prod->quantity = $data->quantity;
            $prod->price = $data->price;
            $prod->description = $data->description;
            $prod->status = $data->status;

            $prod->save();

            $prod->images()->createMany($urlimages);

            Log::channel('contlog')->info('The product: ' . $prod->name . ' has been created by: ' . ' ' . Auth::user()->name . ' ' . Auth::user()->surname);
        }
    }

    public function updateProduct(Request $data, Product $product): void
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

        $product->name = $data->name;
        $product->category_id = $category->id;
        $product->quantity = $data->quantity;
        $product->price = $data->price;
        $product->description = $data->description;
        $product->status = $data->status;

        $product->save();

        $product->images()->createMany($urlimages);

        Log::channel('contlog')->info('The product ' . $product->name . ' has been updated by: ' . ' ' . Auth::user()->name . ' ' . Auth::user()->surname);
    }

    public function categoryForProduct(): Collection
    {
        return Category::cachedCategories();
    }

    public function productsExport(): BinaryFileResponse
    {
        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of products');
        return (new ProductsExport())->download('products.xlsx');
    }

    public function productsImport(Request $request): void
    {
        $file = $request->file('file');
        $import = new ProductsImport();

        try {
            $import->import($file);
            Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has imported a list of products');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                dd($failure);
            }
        }
    }

    public function productsSearch(Request $request): Collection
    {
        $products = Product::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->get(['id', 'name', 'price', 'category_id', 'quantity', 'description', 'created_at']);

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has generated a products report');

        return $products;
    }

    public function categorysearch(Collection $products): array
    {
        $i = 0;

        foreach ($products as $product) {
            $category = Category::where('id', $product->category_id)->first();
            $nameCategory[$i] = $category->name;
            $i++;
        }

        return $nameCategory;
    }
}
