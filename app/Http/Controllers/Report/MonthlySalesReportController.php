<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Repositories\Order\OrderRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonthlySalesReportController extends Controller
{
    protected $orders;

    public function __construct(OrderRepository $OrdersRepository)
    {
        $this->orders = $OrdersRepository;
    }

    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.monthlySales.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request): Response
    {
        $monthlySales = $this->orders->monthlySalesSearch($request);

        $totalSales = $this->orders->totalMonthlySales($monthlySales);

        $count = $this->orders->countMonthlySales($monthlySales);

        $monthsOfYear = $this->orders->monthsOfYear();

        $growth = $this->orders->growthMonthly($totalSales);

        $growthRate = $this->orders->growthRateMonthly($growth, $totalSales);

        $pdf = PDF::loadView('report.monthlySales.monthlySalesReport', compact('monthlySales', 'monthsOfYear', 'count', 'totalSales', 'growth', 'growthRate'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
