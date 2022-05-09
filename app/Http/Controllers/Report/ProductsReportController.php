<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\View\View;

class ProductsReportController extends Controller
{
    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.products.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request)
    {
        $products = Product::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->get(['id', 'name', 'price', 'category_id', 'quantity', 'description', 'created_at']);

        $i = 0;
        foreach ($products as $product) {
            $category = Category::where('id', $product->category_id)->first();
            $nameCategory[$i] = $category->name;
            $i++;
        }

        $pdf = PDF::loadView('report.products.productsReport', compact('products', 'nameCategory'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
