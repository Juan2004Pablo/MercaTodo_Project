@extends('layouts.master')

@section('content')

    <div class="container text-center">

        <div class="page">

            <div class="table-responsive">

                <div class="container text-center">

                    <div class="page-header">

                        <h1><i class="fas fa-shipping-fast"></i>{{ trans('admin.cart.titles.shipping_data_confirmation') }}</h1>

                        <div class="table-responsive">

                            <table class="table table-striped table-hover table-bordered">

                                <tr>

                                    <th>{{ trans('admin.cart.user.name') }}</th>
                                    <th>{{ trans('admin.cart.user.surname') }}</th>
                                    <th>{{ trans('admin.cart.user.address') }}</th>
                                    <th>{{ trans('admin.cart.user.contact') }}</th>

                                </tr>

                                <tr>

                                    <td>{{ $order->name_receive }}</td>
                                    <td>{{ $order->surname}}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>

                                </tr>

                            </table>

                            <p>

                                <a href="{{ route('order-detail') }}" class="btn btn-primary"> <i class="fa fa-chevron-circle-left"></i> {{ trans('admin.cart.titles.back') }} </a>

                                <a href="{{ route('pay.createPay') }}" class="btn btn-primary"> {{ trans('admin.cart.titles.pay') }} <i class="fas fa-money-check-alt"></i></a>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
