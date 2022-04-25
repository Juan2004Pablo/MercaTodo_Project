<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Pay\PaymentRepository;
use App\Repositories\Pay\PlaceToPayRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPayController extends Controller
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
        $this->authorize('pay.create');

        $result = $this->conection->conectionPlaceToPay();
        $this->dataOfOrder($result);

        return redirect()->route('pay.redirection');
    }

    public function redirection(): RedirectResponse
    {
        $this->authorize('pay.redirection');

        $url = $this->pays->redirect();

        return redirect()->to($url);
    }

    public function dataOfOrder(object $data)
    {
        $this->authorize('pay.dataOfOrder');

        $this->pays->ordersData($data);
    }

    public function show(): View
    {
        $this->authorize('pay.Show');

        $payment = $this->pays->seePay();

        return view('product.estado', compact('payment'));
    }

    public function showAllOrders(): View
    {
        $this->authorize('pay.showAll');

        $Payments = $this->pays->seeAllOrders();

        return view('product.payments', compact('Payments'));
    }

    public function updateDataOfPay(object $dato)
    {
        $this->authorize('pay.updateData');

        $this->updateOrderStatus();
        $this->pays->updatePay($dato);
    }

    public function updateOrderStatus(): RedirectResponse
    {
        $this->authorize('pay.updateOrder');

        $this->pays->updateStatusOfOrder();

        return redirect()->route('pay.show');
    }

    public function consultPayment(int $reference): RedirectResponse
    {
        $this->authorize('pay.consultPayment');

        $res = $this->conection->consultPay($reference);

        $this->updateOrderStatus();
        $this->updateDataOfPay($res);

        return redirect()->route('pay.updateOrderStatus');
    }

    public function retryPayment(): RedirectResponse
    {
        $this->authorize('pay.retry');

        return redirect()->route('pay.createPay');
    }
}
