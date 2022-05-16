<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Repositories\Order\OrderRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DailySalesReportController extends Controller
{
    protected $orders;

    public function __construct(OrderRepository $OrdersRepository)
    {
        $this->orders = $OrdersRepository;
    }

    public function index(): View
    {
        $this->authorize('dailySalesReport.generate');

        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.dailySales.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request): Response
    {
        $dailySales = $this->orders->dailySalesSearch($request);

        $productName = $this->orders->productNameSearch($dailySales);

        $totalSales = $this->orders->totalSalesSearch($dailySales);

        $pdf = PDF::loadView('report.dailySales.dailySalesReport', compact('dailySales', 'totalSales', 'productName'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
