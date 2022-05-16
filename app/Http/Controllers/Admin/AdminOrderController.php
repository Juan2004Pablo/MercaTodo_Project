<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    protected $orders;

    public function __construct(OrderRepository $OrdersRepository)
    {
        $this->orders = $OrdersRepository;
    }

    public function index(Request $request): View
    {
        $this->authorize('order.index');

        $orders = $this->orders->getAllOrders($request);

        $request = $request->all();

        return view('admin.order.index', compact('orders', 'request'));
    }
}
