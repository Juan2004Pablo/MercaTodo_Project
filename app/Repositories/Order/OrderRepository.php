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
}
