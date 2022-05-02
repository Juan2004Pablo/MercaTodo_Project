<?php

namespace App\Http\Controllers;

use App\Repositories\product\ProductRepository;

class ExportProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function export()
    {
        $this->authorize('products.export');

        return $this->productRepo->productsExport();
    }
}
