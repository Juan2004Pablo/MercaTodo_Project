<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\View\View;

class DailySalesReportController extends Controller
{
    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.dailySales.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request)
    {
        $totalSales[] = 0;
        $productName[] = null;

        $dailySales = Order::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->where('status', 'APPROVED')->orderBy('created_at', 'Asc')
            ->get(['created_at', 'id', 'code', 'status', 'total']);

        $i = 1;
        $j = 0;
        foreach ($dailySales as $dailySale) {
            $details = Detail::where('order_id', $dailySale->id)->get(['id', 'products_id', 'order_id']);
            foreach ($details as $detail) {
                $products = Product::find($detail->products_id);
                $productName[$j] = $products->name;
                $j++;
            }

            $totalSales[$i] = $totalSales[$i - 1] + $dailySale->total;
            $i = $i + 1;
        }

        $pdf = PDF::loadView('report.dailySales.dailySalesReport', compact('dailySales', 'totalSales', 'productName'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
