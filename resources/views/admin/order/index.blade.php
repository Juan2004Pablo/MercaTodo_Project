@extends('template.admin')

@section('title','Administration of orders')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="row">

    <span style="display:none;">{{route('admin.order.index')}}</span>

    <div class="col-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">{{ trans('admin.orders.titles.section') }}</h3>

                <div class="card-tools">

                    <nav class="navbar navbar-light bg-light">
                        @include('custom.modal_search-orders')
                    </nav>

                </div>

            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">

                <table class="table table-head-fixed text-nowrap">

                    <thead>

                        <tr>

                            <th>{{ trans('admin.orders.fields.code') }}</th>
                            <th>{{ trans('admin.orders.fields.status') }}</th>
                            <th colspan="3"></th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>{{$order->code}}</td>
                                <td>{{$order->status}}</td>

                                <td>
                                    <a class="btn btn-default" href="{{ route('admin.order.show',$order->id) }}">{{ trans('admin.orders.options.show') }}</a>
                                </td>
                                
                            </tr>

                        @endforeach

                    </tbody>

                </table>
                
            </div>

        </div>

    </div>

</div>
@endsection
