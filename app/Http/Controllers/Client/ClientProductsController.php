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
        $products = Product::select('*')->orderBy('id', 'DESC')->withCount('images');
        $limit=(isset($request->limit)) ? $request->limit:10;
        
        if(isset($request->search)){
            $products = $products->where('id', 'like', '%'.$request->search.'%')
            ->orWhere('name','like','%'.$request->search.'%')
            ->orWhere('price','like','%'.$request->search.'%')
            ->orWhere('description','like','%'.$request->search.'%');
        }
        $products = $products->paginate($limit)->appends($request->all());
        return view('client.products.index', compact('products'));
    }
}
