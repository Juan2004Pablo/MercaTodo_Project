<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\product\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public $statusProducts = ['', 'New', 'Used'];

    public function index(Request $request): View
    {
        $this->authorize('product.index');

        $products = $this->productRepo->getAllProductAdmin($request);
        $category = $this->productRepo->categoryForProduct();

        $request = $request->all();

        return view('admin.product.index', compact('products', 'category', 'request'));
    }

    public function create(): View
    {
        $this->authorize('product.create');

        $statusProducts = $this->statusProducts;

        $categories = $this->productRepo->categoryForProduct();

        return view('admin.product.create', compact('categories', 'statusProducts'));
    }

    public function store(StoreProductRequest $request): void
    {
        $this->authorize('product.create');

        $this->productRepo->createProduct($request);
    }

    public function edit(Product $product): View
    {
        $this->authorize('product.update');

        $statusProducts = $this->statusProducts;

        return view('admin.product.edit', compact('product', 'statusProducts'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('product.update');

        $this->productRepo->updateProduct($request, $product);

        return redirect()->route('admin.product.index')->with('data', 'Record updated successfully!');
    }

    public function show(Product $product): View
    {
        $this->authorize('product.show');

        $statusProducts = $this->statusProducts;

        return view('admin.product.show', compact('product', 'statusProducts'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('product.disable');

        $this->productRepo->delete($product);

        return redirect()->route('admin.product.index')->with('data', 'Product disabled');
    }

    public function restore(Request $request): RedirectResponse
    {
        $this->authorize('product.disable');

        $this->productRepo->restore($request);

        return redirect()->route('admin.product.index')->with('data', 'Product  enabled');
    }
}
