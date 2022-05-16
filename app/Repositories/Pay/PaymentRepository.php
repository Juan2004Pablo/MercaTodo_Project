<?php

namespace App\Repositories\Pay;

use App\Jobs\UpdateStatusPay;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Pay;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentRepository extends BaseRepository
{
    public function getModel(): Pay
    {
        return new Pay();
    }

    public function redirect(): string
    {
        $pay = Pay::inProcess()->first();

        return $pay->process_url;
    }

    public function ordersData(object $data): void
    {
        $order = Order::open()->rejected()->first();

        $paymen = new Pay();
        $paymen->status;
        $paymen->reference = $order->id;
        $paymen->requestId = $data->requestId;
        $paymen->process_url = $data->processUrl;
        $paymen->user_id = Auth::user()->id;
        $paymen->name;
        $paymen->surname;
        $paymen->email;
        $paymen->phone = Auth::user()->phone;
        $paymen->payment_method;
        $paymen->order_total = $order->total;
        $paymen->save();
    }

    public function updatePay(object $dato): void
    {
        $paymen = Pay::where('requestId', $dato->requestId)->first();

        $paymen->status = $dato->status->status;
        $paymen->name = $dato->request->payer->name;
        $paymen->surname = $dato->request->payer->surname;
        $paymen->email = $dato->request->payer->email;
        $paymen->phone = Auth::user()->phone;

        if ($dato->status->status == 'PENDING') {
            $paymen->payment_method = 'PENDING';

            UpdateStatusPay::dispatch($paymen);
        } else {
            foreach ($dato->payment as $d) {
                $paymen->payment_method = $d->paymentMethod;
            }
        }
        $paymen->save();

        Log::channel('contlog')->info('payment made by:' .
            $paymen->name . ' ' . $paymen->surname . ' ' .
            'With identification' . ' ' . $paymen->document);
    }

    public function updateDatesJob(object $dato): void
    {
        $paymen = Pay::where('requestId', $dato->requestId)->pending()->first();

        $paymen->status = $dato->status->status;
        $paymen->name = $dato->request->payer->name;
        $paymen->surname = $dato->request->payer->surname;
        $paymen->email = $dato->request->payer->email;

        if ($dato->status->status == 'PENDING') {
            $paymen->payment_method = 'PENDING';

            UpdateStatusPay::dispatch($paymen)->delay(now()->addMinutes(15));
        } else {
            foreach ($dato->payment as $d) {
                $paymen->payment_method = $d->paymentMethod;
            }
        }
        $paymen->save();

        $order = Order::where('id', $paymen->reference)->first();
        $order->status = $paymen->status;
        $order->save();

        Log::channel('contlog')->info('payment made by:' .
            $paymen->name . ' ' . $paymen->surname . ' ' .
            'With identification' . ' ' . $paymen->document);
    }

    public function seePay(): Model
    {
        return $this->getModel()->all()->where('user_id', Auth::user()->id)->last();
    }

    public function updateStatusOfOrder(): string
    {
        $order = Order::open()->rejected()->Orwhere('status', '=', 'PENDING')->first();
        $payer = Pay::all()->where('reference', $order->id)->last();
        $order->status = $payer->status;
        $order->save();
        if ($order->status == 'APPROVED') {
            $detail = Detail::where('order_id', $order->id)->get();
            foreach ($detail as $d) {
                $product = Product::where('id', $d->products_id)->get();

                foreach ($product as $p) {
                    $p->quantity = $p->quantity - $d->quantity;
                    $p->save();
                }
            }
        }
        return $order;
    }

    public function seeAllOrders(): Collection
    {
        $c = 0;
        $pays = $this->getModel()->all()->where('user_id', Auth::user()->id);
        foreach ($pays as $p) {
            if ($this->countPays($p->reference) > 0 & $p->status == 'REJECTED') {
                $pays->forget($c);
            }
            $c += 1;
        }

        return $pays;
    }

    public function countPays(int $reference): int
    {
        return $this->getModel()->all()->where('status', 'APPROVED')
            ->where('reference', $reference)->count();
    }
}
