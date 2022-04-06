<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository;
use App\Repositories\PlaceToPayRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class PayController extends Controller
{
    protected $conection;
    protected $pays;

    public function __construct(PlaceToPayRepository $conectionP, PaymentRepository $pay)
    {
        $this->conection = $conectionP;
        $this->pays = $pay;
    }

    public function createPay(): RedirectResponse
    {
        $result = $this->conection->conectionPlaceToPay();
        $this->dataOfOrder($result);

        return redirect()->route('pay.redirection');
    }

    public function redirection(): RedirectResponse
    {
        $url = $this->pays->redirect();

        return redirect()->to($url);
    }

    public function dataOfOrder(object $data)
    {
        $this->pays->ordersData($data);
    }

    public function consultPayment(int $reference): RedirectResponse
    {
        $res = $this->conection->consultPay($reference);

        $this->updateDataOfPay($res);

        return redirect()->route('pay.updateOrderStatus');
    }

    public function updateDataOfPay(object $dato)
    {
        $this->pays->updatePay($dato);
    }

    public function show(): View
    {
        $payment = $this->pays->seePay();

        return view('product.estado', compact('payment'));
    }

    public function updateOrderStatus(): RedirectResponse
    {
        $this->pays->updateStatusOfOrder();

        return redirect()->route('pay.show');
    }

    public function showAllOrders(): View
    {
        $Payments = $this->pays->seeAllOrders();

        return view('product.payments', compact('Payments'));
    }

    public function retryPayment(): RedirectResponse
    {
        return redirect()->route('pay.createPay');
    }
}
