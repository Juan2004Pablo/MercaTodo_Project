<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Repositories\Order\OrderRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;

class salesByDaysReportController extends Controller
{
    protected $orders;

    public function __construct(OrderRepository $OrdersRepository)
    {
        $this->orders = $OrdersRepository;
    }

    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.salesByDays.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request): Response
    {
        $salesByDays = $this->orders->salesByDaysSearch($request);

        $day = $this->orders->daySearch($salesByDays);

        $subTotal = $this->orders->subTotalSearch($salesByDays, $day);

        $daysOfWeek = $this->orders->daysOfWeek();

        $growth = $this->orders->growthSalesDays($subTotal);

        $growthRate = $this->orders->growthRateSalesDay($growth, $subTotal);

        $pdf = PDF::loadView('report.salesByDays.salesByDaysReport', compact('salesByDays', 'day', 'subTotal', 'daysOfWeek', 'growth', 'growthRate'));
        return $pdf->stream();
    }
}
