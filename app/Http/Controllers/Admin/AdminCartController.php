<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminCartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartRepository $carRepository)
    {
        $this->cartRepo = $carRepository;
    }

    public function show(): View
    {
        $cart = $this->cartRepo->getProductsOfCart();
        $total = $this->cartRepo->total();

        return view('product.cart', compact('cart', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $this->cartRepo->addToCart($request);

        return redirect()->route('cart.show');
    }

    public function delete(Request $request): RedirectResponse
    {
        $this->cartRepo->deleteProductOfCart($request);

        return redirect()->route('cart.show');
    }

    public function trash(): RedirectResponse
    {
        $this->cartRepo->emptyCart();

        return redirect()->route('home');
    }

    public function update(int $id, int $quantity): RedirectResponse
    {
        $this->cartRepo->updateQuantity($id, $quantity);

        return redirect()->route('cart.show');
    }

    public function datesReceive(Request $request): View
    {
        $order = $this->cartRepo->datesReceiveOrder($request);

        return view('product.pay', compact('order'));
    }

    public function orderDetail(): View
    {
        $cart = $this->cartRepo->detail();

        return view('product.order-detail', compact('cart'));
    }
}
