<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartRepository $carRepository)
    {
        $this->cartRepo = $carRepository;
    }

    public function add(Request $request): RedirectResponse
    {
        $this->authorize('cart.add');

        $this->cartRepo->addToCart($request);

        return redirect()->route('cart.show');
    }

    public function show(): View
    {
        $this->authorize('cart.show');

        $cart = $this->cartRepo->getProductsOfCart();
        $total = $this->cartRepo->total();

        return view('product.cart', compact('cart', 'total'));
    }

    public function update(int $id, int $quantity): RedirectResponse
    {
        $this->authorize('cart.update');

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

    public function delete(Request $request): RedirectResponse
    {
        $this->authorize('cart.delete');

        $this->cartRepo->deleteProductOfCart($request);

        return redirect()->route('cart.show');
    }

    public function trash(): RedirectResponse
    {
        $this->authorize('cart.trash');

        $this->cartRepo->emptyCart();

        return redirect()->route('home');
    }
}
