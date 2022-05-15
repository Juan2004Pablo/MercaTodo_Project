<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\View\View;

class salesByDaysReportController extends Controller
{
    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.salesByDays.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request)
    {
        $salesByDays = Order::whereDate('created_at', '>=', $request->get('initial-date'))
                            ->whereDate('created_at', '<=', $request->get('end-date'))
                            ->where('status', 'APPROVED')->orderBy('created_at', 'Asc')
                            ->get(['created_at', 'id', 'code', 'status', 'total']);

        for ($j = 0; $j < 7; $j++) {
            $subTotal[$j] = 0;
        }

        $daysOfWeek[0] = 'Monday';
        $daysOfWeek[1] = 'Tuesday';
        $daysOfWeek[2] = 'Wednesday';
        $daysOfWeek[3] = 'Thursday';
        $daysOfWeek[4] = 'Friday';
        $daysOfWeek[5] = 'Saturday';
        $daysOfWeek[6] = 'Sunday';

        $i = 0;

        foreach ($salesByDays as $salesByDay) {
            $day[$i] = $salesByDay->created_at->isoFormat('dddd');

            switch ($day[$i]) {
                case 'Monday':
                    $subTotal[0] = $subTotal[0] + $salesByDay->total;
                break;

                case 'Tuesday':
                    $subTotal[1] = $subTotal[1] + $salesByDay->total;
                break;

                case 'Wednesday':
                    $subTotal[2] = $subTotal[2] + $salesByDay->total;
                break;

                case 'Thursday':
                    $subTotal[3] = $subTotal[3] + $salesByDay->total;
                break;

                case 'Friday':
                    $subTotal[4] = $subTotal[4] + $salesByDay->total;
                break;

                case 'Saturday':
                    $subTotal[5] = $subTotal[5] + $salesByDay->total;
                break;

                case 'Sunday':
                    $subTotal[6] = $subTotal[6] + $salesByDay->total;
                break;
            }
            $i++;
        }

        for ($i = 0; $i < 7; $i++) {
            if ($i === 0) {
                $growth[$i] = $subTotal[$i] - $subTotal[6];
                if ($subTotal[6] > 0) {
                    $growthRate[$i] = ($growth[$i] / $subTotal[6]) * 100;
                } else {
                    $growthRate[$i] = null;
                }
            } else {
                $growth[$i] = $subTotal[$i] - $subTotal[$i - 1];
                if ($subTotal[$i - 1] > 0) {
                    $growthRate[$i] = $growth[$i] / $subTotal[$i - 1] * 100;
                } else {
                    $growthRate[$i] = null;
                }
            }
        }

        $pdf = PDF::loadView('report.salesByDays.salesByDaysReport', compact('salesByDays', 'day', 'subTotal', 'daysOfWeek', 'growth', 'growthRate'));
        return $pdf->stream();
    }
}
