<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\View\View;

class MonthlySalesReportController extends Controller
{
    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.monthlySales.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request)
    {
        $monthlySales = Order::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->where('status', 'APPROVED')->orderBy('created_at', 'Asc')
            ->get(['created_at', 'id', 'code', 'status', 'total']);

        $i = 0;

        for ($j = 0; $j < 12; $j++) {
            $totalSales[$j] = 0;
            $count[$j] = 0;
            $growth[$j] = 0;
        }

        //Get month of each record
        foreach ($monthlySales as $monthlySale) {
            $months[$i] = $monthlySale->created_at->format('F');

            //Get total for each month
            //Get the amount of approved purchases in each month
            switch ($months[$i]) {
                case 'January':
                    $totalSales[0] = $totalSales[0] + $monthlySale->total;
                    $count[0] = $count[0] + 1;
                    break;

                case 'February':
                    $totalSales[1] = $totalSales[1] + $monthlySale->total;
                    $count[1] = $count[1] + 1;
                    break;

                case 'March':
                    $totalSales[2] = $totalSales[2] + $monthlySale->total;
                    $count[2] = $count[2] + 2;
                    break;

                case 'April':
                    $totalSales[3] = $totalSales[3] + $monthlySale->total;
                    $count[3] = $count[3] + 1;
                    break;

                case 'May':
                    $totalSales[4] = $totalSales[4] + $monthlySale->total;
                    $count[4] = $count[4] + 1;
                    break;

                case 'June':
                    $totalSales[5] = $totalSales[5] + $monthlySale->total;
                    $count[5] = $count[5] + 1;
                    break;

                case 'July':
                    $totalSales[6] = $totalSales[6] + $monthlySale->total;
                    $count[6] = $count[6] + 1;
                    break;

                case 'August':
                    $totalSales[7] = $totalSales[7] + $monthlySale->total;
                    $count[7] = $count[7] + 1;
                    break;

                case 'September':
                    $totalSales[8] = $totalSales[8] + $monthlySale->total;
                    $count[8] = $count[8] + 1;
                    break;

                case 'October':
                    $totalSales[9] = $totalSales[9] + $monthlySale->total;
                    $count[9] = $count[9] + 1;
                    break;

                case 'November':
                    $totalSales[10] = $totalSales[10] + $monthlySale->total;
                    $count[10] = $count[10] + 1;
                    break;

                case 'December':
                    $totalSales[11] = $totalSales[11] + $monthlySale->total;
                    $count[11] = $count[11] + 1;
                    break;
            }

            $i++;
        }

        for ($i = 0; $i < 12; $i++) {
            if ($i === 0) {
                $growth[$i] = $totalSales[$i] - $totalSales[11];
                if ($totalSales[11] > 0) {
                    $growthRate[$i] = $growth[$i] / $totalSales[11];
                } else {
                    $growthRate[$i] = null;
                }
            } else {
                $growth[$i] = $totalSales[$i] - $totalSales[$i - 1];
                if ($totalSales[$i - 1] > 0) {
                    $growthRate[$i] = $growth[$i] / $totalSales[$i - 1];
                } else {
                    $growthRate[$i] = null;
                }
            }
        }

        $pdf = PDF::loadView('report.monthlySales.monthlySalesReport', compact('monthlySales', 'months', 'count', 'totalSales', 'growth', 'growthRate'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
