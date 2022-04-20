<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $products = $this->productRepo->getAllProductAdmin($request);
        $category = $this->productRepo->categoryForProduct();

        $request = $request->all();

        return view('admin.product.index', compact('products', 'category', 'request'));
    }

    public function create(): View
    {
        $statusProducts = $this->statusProducts;

        $categories = $this->productRepo->categoryForProduct();

        return view('admin.product.create', compact('categories', 'statusProducts'));
    }

    public function store(StoreProductRequest $request)//: RedirectResponse
    {
        $this->productRepo->createProduct($request);

        //return redirect()->route('admin.product.index')
           // ->with('data', 'Record created successfully!');
    }

    public function show(int $id): View
    {
        $product = $this->productRepo->getProductbyId($id);

        $statusProducts = $this->statusProducts;

        return view('admin.product.show', compact('product', 'statusProducts'));
    }

    public function edit(int $id): View
    {
        $product = $this->productRepo->getProductbyId($id);

        $statusProducts = $this->statusProducts;

        return view('admin.product.edit', compact('product', 'statusProducts'));
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $this->productRepo->updateProduct($request, $id);

        return redirect()->route('admin.product.index')
            ->with('data', 'Record updated successfully!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = $this->productRepo->findId($id);
        $this->productRepo->delete($product);

        return redirect()->route('admin.product.index')
            ->with('data', 'Product disabled');
    }

    public function restore(Request $request): RedirectResponse
    {
        $this->productRepo->restore($request);

        return redirect()->route('admin.product.index')
            ->with('data', 'Product  enabled');
    }
}
