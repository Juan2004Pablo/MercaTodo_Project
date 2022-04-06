<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orders;

    public function __construct(OrderRepository $OrdersRepository)
    {
        $this->orders = $OrdersRepository;
    }

    public function index(Request $request): View
    {
        $orders = $this->orders->getAllOrders($request);

        $request = $request->all();

        return view('admin.order.index', compact('orders', 'request'));
    }

    public function show(int $id): RedirectResponse
    {
        $this->orders->seeOrder($id);

        return redirect('/admin/detail');
    }
}
