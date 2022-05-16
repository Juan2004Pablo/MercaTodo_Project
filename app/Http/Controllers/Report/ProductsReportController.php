<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Repositories\product\ProductRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductsReportController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.products.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request): Response
    {
        $products = $this->productRepo->productsSearch($request);

        $nameCategory = $this->productRepo->categorySearch($products);

        $pdf = PDF::loadView('report.products.productsReport', compact('products', 'nameCategory'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
