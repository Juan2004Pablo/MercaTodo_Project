<?php

namespace App\Http\Controllers;

use App\Repositories\product\ProductRepository;
use Illuminate\View\View;

class ShowProductController extends Controller
{
    protected $productsRepo;

    public function __construct(ProductRepository $productsRepository)
    {
        $this->productsRepo = $productsRepository;
    }

    public function show(int $id): View
    {
        $product = $this->productsRepo->findId($id);

        return view('product.show', compact('product'));
    }
}
