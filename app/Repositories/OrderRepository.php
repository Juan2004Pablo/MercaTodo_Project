<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class OrderRepository extends BaseRepository
{
    public function getModel(): Order
    {
        return new Order();
        Cache::flush();
    }

    public function getAllOrders(Request $request)
    {
        $status = $request->get('searchbystate');
        $date = $request->get('searchbydate');

        if (request()->page)
        {
            $key = 'orders' . request()->page;
        }else{
            $key = 'orders';
        }

        if (Cache::has($key))
        {
            $orders = Cache::get($key);
        } else{
            $orders = Order::statusorder($status)->dateorder($date)->paginate(8);
            Cache::put($key, $orders);
        }
        return $orders;
    }

    public function seeOrder(int $id): void
    {
        Session::put('order_id', $id);
    }
}
