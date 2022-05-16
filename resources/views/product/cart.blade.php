@extends('layouts.master')

@section('content')

    <div class="container text-center">

        <div class="page-header">

            <h1><i class="fa fa-shopping-cart"> </i>{{ trans('admin.cart.titles.title') }}</h1>

        </div>

        <div class="page">

            @if($cart)

                <div class="table-responsive">

                    <table class="table table-striped table-hover table-bordered">

                        <thead>

                            <tr>

                                <th>{{ trans('admin.cart.fields.image') }}</th>
                                <th>{{ trans('admin.cart.fields.product') }}</th>
                                <th>{{ trans('admin.cart.fields.price') }}</th>
                                <th>{{ trans('admin.cart.fields.quantity') }}</th>
                                <th>{{ trans('admin.cart.fields.subtotal') }}</th>
                                <th>{{ trans('admin.cart.fields.delete') }}</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($cart->details as $item)

                                <tr>

                                    <td><img class="bd-placeholder-img" src="{{  $item->products->images->random()->url }}" width="267" height="225" title="products"></td>
                                    <td>{{ $item->products->name}}</td>
                                    <td>COP {{ number_format($item->products->price,0) }}</td>
                                    <td>
                                        <input type="number" min="1" max="{{ $item->products->quantity }}" value="{{ $item->quantity }}" id="product_{{ $item->products->id }}">
                                    </td>
                                    <td>COP {{ number_format($item->products->price * $item->quantity,0) }}</td>
                                    <td>
                                        <a href="{{ route('cart.delete', $item->products->id) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <hr>

                    <h3>

                        <span class="label label-success">
                            Total: COP {{ number_format($total,0) }}
                        </span>

                    </h3>

                </div>

            @else

                <h3><span class="label label-warning">{{ trans('admin.cart.titles.message') }}</span></h3>

            @endif

            <hr>

            <p>

                <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i>{{ trans('admin.cart.titles.keep_buying') }}</a>

                <a href="{{ route('order-detail') }}" class="btn btn-primary">{{ trans('admin.cart.titles.continue') }}<i class="fa fa-chevron-circle-right"></i></a>

            </p>

            <a href="{{ route('cart.trash') }}" class="btn btn-danger">{{ trans('admin.cart.titles.empty_cart') }}<i class="fas fa-trash-alt"></i></a>
        
        </div>

    </div>

@stop
