<?php

namespace App\Http\Controllers\Client;

use App\Actions\StoreProductImagesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClientProductsController extends Controller
{
    public function index(Request $request)
    {
        if($request) {
            $query = trim($request->get('search'));

            $products = Product::where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('id','asc')
                ->get();

            return view('client.products.index', ['products' => $products, 'search' => $query]);
        }
    }
}
