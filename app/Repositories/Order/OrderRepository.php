<?php

namespace App\Repositories\Order;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class OrderRepository extends BaseRepository
{
    public function getModel(): Order
    {
        Cache::flush();
        return new Order();
    }

    public function getAllOrders(Request $request): LengthAwarePaginator
    {
        $status = $request->get('searchbystate');
        $date = $request->get('searchbydate');

        if (request()->page) {
            $key = 'orders' . request()->page;
        } else {
            $key = 'orders';
        }

        if (Cache::has($key)) {
            $orders = Cache::get($key);
        } else {
            $orders = Order::statusorder($status)->dateorder($date)->paginate(8);
            Cache::put($key, $orders);
        }

        return $orders;
    }

    public function dailySalesSearch(Request $request): Collection
    {
        $dailySales = Order::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->where('status', 'APPROVED')->orderBy('created_at', 'Asc')
            ->get(['created_at', 'id', 'code', 'status', 'total']);

        return $dailySales;
    }

    public function productNameSearch(Collection $dailySales): array
    {
        $productName[] = null;
        $j = 0;

        foreach ($dailySales as $dailySale) {
            $details = Detail::where('order_id', $dailySale->id)->get(['id', 'products_id', 'order_id']);
            foreach ($details as $detail) {
                $products = Product::find($detail->products_id);
                $productName[$j] = $products->name;
                $j++;
            }
        }

        return $productName;
    }

    public function totalSalesSearch(Collection $dailySales): array
    {
        $totalSales[] = 0;
        $i = 1;

        foreach ($dailySales as $dailySale) {
            $totalSales[$i] = $totalSales[$i - 1] + $dailySale->total;
            $i = $i + 1;
        }

        return $totalSales;
    }

    public function monthlySalesSearch(Request $request): Collection
    {
        $monthlySales = Order::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))
            ->where('status', 'APPROVED')->orderBy('created_at', 'Asc')
            ->get(['created_at', 'id', 'code', 'status', 'total']);

        return $monthlySales;
    }

    public function monthsOfYear(): array
    {
        $monthsOfYear[0] = 'January';
        $monthsOfYear[1] = 'February';
        $monthsOfYear[2] = 'March';
        $monthsOfYear[3] = 'April';
        $monthsOfYear[4] = 'May';
        $monthsOfYear[5] = 'June';
        $monthsOfYear[6] = 'July';
        $monthsOfYear[7] = 'August';
        $monthsOfYear[8] = 'September';
        $monthsOfYear[9] = 'October';
        $monthsOfYear[10] = 'November';
        $monthsOfYear[11] = 'December';

        return $monthsOfYear;
    }

    public function totalMonthlySales(Collection $monthlySales): array
    {
        $i = 0;

        for ($j = 0; $j < 12; $j++) {
            $totalSales[$j] = 0;
        }

        //Get month of each record
        foreach ($monthlySales as $monthlySale) {
            $months[$i] = $monthlySale->created_at->format('F');

            //Get total for each month
            //Get the amount of approved purchases in each month
            switch ($months[$i]) {
                case 'January':
                    $totalSales[0] = $totalSales[0] + $monthlySale->total;
                    break;

                case 'February':
                    $totalSales[1] = $totalSales[1] + $monthlySale->total;
                    break;

                case 'March':
                    $totalSales[2] = $totalSales[2] + $monthlySale->total;
                    break;

                case 'April':
                    $totalSales[3] = $totalSales[3] + $monthlySale->total;
                    break;

                case 'May':
                    $totalSales[4] = $totalSales[4] + $monthlySale->total;
                    break;

                case 'June':
                    $totalSales[5] = $totalSales[5] + $monthlySale->total;
                    break;

                case 'July':
                    $totalSales[6] = $totalSales[6] + $monthlySale->total;
                    break;

                case 'August':
                    $totalSales[7] = $totalSales[7] + $monthlySale->total;
                    break;

                case 'September':
                    $totalSales[8] = $totalSales[8] + $monthlySale->total;
                    break;

                case 'October':
                    $totalSales[9] = $totalSales[9] + $monthlySale->total;
                    break;

                case 'November':
                    $totalSales[10] = $totalSales[10] + $monthlySale->total;
                    break;

                case 'December':
                    $totalSales[11] = $totalSales[11] + $monthlySale->total;
                    break;
            }

            $i++;
        }

        return $totalSales;
    }

    public function countMonthlySales(Collection $monthlySales): array
    {
        $i = 0;

        for ($j = 0; $j < 12; $j++) {
            $count[$j] = 0;
        }

        //Get month of each record
        foreach ($monthlySales as $monthlySale) {
            $months[$i] = $monthlySale->created_at->format('F');

            //Get total for each month
            //Get the amount of approved purchases in each month
            switch ($months[$i]) {
                case 'January':
                    $count[0] = $count[0] + 1;
                    break;

                case 'February':
                    $count[1] = $count[1] + 1;
                    break;

                case 'March':
                    $count[2] = $count[2] + 2;
                    break;

                case 'April':
                    $count[3] = $count[3] + 1;
                    break;

                case 'May':
                    $count[4] = $count[4] + 1;
                    break;

                case 'June':
                    $count[5] = $count[5] + 1;
                    break;

                case 'July':
                    $count[6] = $count[6] + 1;
                    break;

                case 'August':
                    $count[7] = $count[7] + 1;
                    break;

                case 'September':
                    $count[8] = $count[8] + 1;
                    break;

                case 'October':
                    $count[9] = $count[9] + 1;
                    break;

                case 'November':
                    $count[10] = $count[10] + 1;
                    break;

                case 'December':
                    $count[11] = $count[11] + 1;
                    break;
            }

            $i++;
        }

        return $count;
    }

    public function growthMonthly(array $totalSales): array
    {
        for ($j = 0; $j < 12; $j++) {
            $growth[$j] = 0;
        }

        for ($i = 0; $i < 12; $i++) {
            if ($i === 0) {
                $growth[$i] = $totalSales[$i] - $totalSales[11];
            } else {
                $growth[$i] = $totalSales[$i] - $totalSales[$i - 1];
            }
        }

        return $growth;
    }

    public function growthRateMonthly(array $growth, array $totalSales): array
    {
        for ($i = 0; $i < 12; $i++) {
            if ($i === 0) {
                if ($totalSales[11] > 0) {
                    $growthRate[$i] = $growth[$i] / $totalSales[11] * 100;
                } else {
                    $growthRate[$i] = null;
                }
            } else {
                if ($totalSales[$i - 1] > 0) {
                    $growthRate[$i] = $growth[$i] / $totalSales[$i - 1] * 100;
                } else {
                    $growthRate[$i] = null;
                }
            }
        }

        return $growthRate;
    }
}
