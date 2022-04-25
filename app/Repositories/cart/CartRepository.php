<?php

namespace App\Repositories\cart;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartRepository extends BaseRepository
{
    public function getModel(): Order
    {
        return new Order();
    }

    public function addToCart(Request $data): void
    {
        $order = Order::open()->first();

        if ($order) {
            $product = Product::find($data->id);
            $product->quantity = 1;
            $cart[$product->id] = $product;

            $detailproduct = Detail::where('order_id', $order->id)->where('products_id', $product->id)->first();
            if (!$detailproduct) {
                $detail = new Detail();
                $detail->quantity = 1;
                $detail->products_id = $product->id;
                $detail->unit_price = $product->price;
                $detail->order_id = $order->id;
                $detail->save();
                $this->updateTotal($order, $this->total());
            }
        } else {
            $product = Product::find($data->id);
            $product->quantity = 1;
            $cart[$product->id] = $product;

            $order = new Order();
            $order->code = time();
            $order->total = $this->total();
            $order->status = 'PENDING';
            $order->user_id = Auth::user()->id;
            $order->name_receive = Auth::user()->name;
            $order->surname = Auth::user()->surname;
            $order->address = Auth::user()->address;
            $order->phone = Auth::user()->phone;
            $order->save();

            foreach ($cart as $r) {
                $detail = new Detail();
                $detail->quantity = $r->quantity;
                $detail->products_id = $r->id;
                $detail->unit_price = $r->price;
                $detail->order_id = $order->id;
                $detail->save();
                $this->updateTotal($order, $this->total());
            }
        }
    }

    public function updateQuantity(int $id, int $quantity): void
    {
        $product = Product::where('id', $id)->first();
        $order = Order::open()->first();
        $detailproduct = Detail::where('order_id', $order->id)
            ->where('products_id', $product->id)->first();

        $detailproduct->quantity = $quantity;
        $detailproduct->save();
        $this->updateTotal($order, $this->total());
    }

    public function total(): int
    {
        $cart = $this->getModel()->with('details.products')->open()->get();

        $total = 0;

        foreach ($cart as $item) {
            foreach ($item->details as $i) {
                $total += $i->products->price * $i->quantity;
            }
        }

        return $total;
    }

    public function updateTotal(Order $order, int $total): void
    {
        $order->total = $total;
        $order->save();
    }

    public function deleteProductOfCart(Request $data): void
    {
        $product = Product::find($data->id);
        $order = Order::open()->first();
        $detailproduct = Detail::where('order_id', $order->id)->where('products_id', $product->id)->first();
        $detailproduct->delete();
    }

    public function emptyCart(): void
    {
        $order = Order::open()->first();
        Detail::where('order_id', $order->id)->delete();
        Order::open()->delete();
    }

    public function datesReceiveOrder(Request $data): Model
    {
        $order = $this->getModel()->open()->first();
        $order->name_receive = $data->name_receive;
        $order->surname = $data->surname;
        $order->address = $data->address;
        $order->phone = $data->phone;
        $order->save();

        return $order;
    }

    public function detail(): Model
    {
        return $this->getModel()->with('details', 'details.products')->open()->first();
    }
}
