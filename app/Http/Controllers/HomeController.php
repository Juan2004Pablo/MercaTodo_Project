<?php

namespace App\Http\Controllers;

use App\Repositories\cart\CartRepository;
use App\Repositories\product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;

class HomeController extends Controller
{
    protected $cartShowRepo;
    protected $prodRepo;

    public function __construct(ProductRepository $prodRepository, CartRepository $cartRepository)
    {
        $this->prodRepo = $prodRepository;
        $this->cartShowRepo = $cartRepository;
    }

    public function index(Request $request): View
    {
        $products = $this->prodRepo->getAllProductHome($request);
        $carts = $this->cartShowRepo->getProductsOfCart();
        $categories = Category::cachedCategories();
        return view('home', compact('products', 'carts', 'categories'));
    }
}
