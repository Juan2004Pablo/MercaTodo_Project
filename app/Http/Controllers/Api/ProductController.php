<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\product\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $products = Product::paginate(env('PAGINATE'));

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productRepo->createProduct($request);

        return response()->json([
            'message' => 'The product has been created :)',
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $productUpdated = $this->productRepo->updateProduct($request, $product);

        return response()->json([
            'message' => 'The product has been updated :)',
        ]);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $exist = Detail::select('order_id')->where('products_id', $product->id)->first();

        if ($exist === null) {
            $product->delete();

            return response()->json([
                'message' => 'I dont exist anymore :(',
            ]);
        } else {
            $exist = Order::where('id', $exist->order_id)->where('status', '!=', 'REJECTED')->first();
            if ($exist === null) {
                $product->delete();

                return response()->json([
                    'message' => 'I dont exist anymore :(',
                ]);
            } else {
                return response()->json([
                    'message' => 'You cannot delete the product because it has at least one payment',
                ]);
            }
        }
    }
}
