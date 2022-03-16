<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreProductImagesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::select(['id', 'name', 'price', 'quantity', 'disable_at'])->withCount('images')->paginate();
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
        //\Log::info('The product with id: ' . $product->id . ' has been created');
    }

    public function store(StoreProductRequest $request, StoreProductImagesAction $imagesAction): RedirectResponse
    {
        $product = new Product();
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');

        $product->save();

        $imagesAction->execute($request->images, $product);

        return redirect(route('products.show', $product));
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit($id): View
    {
        $product = Product::find($id);

        return view('admin.products.update', compact('product'));
    }

    public function update(StoreProductRequest $request, Product $product, StoreProductImagesAction $imagesAction): RedirectResponse
    {
        $product->code = $request->get('code');
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->get('description');

        $product->save();

        $imagesAction->execute($request->images, $product);

        return redirect(route('products.show', $product));
        //return route('products.index');
    }

    public function toggle(Product $product)
    {
        $product->disable_at = $product->disable_at ? null : now();

        $product->save();

        if ($product->disable_at == null)
        {
            \Log::warning('enabled product with id: '.$product->id);
        } else{
            \Log::warning('disabled product with id: '.$product->id);
        }
        return redirect()->back();
    }
}
