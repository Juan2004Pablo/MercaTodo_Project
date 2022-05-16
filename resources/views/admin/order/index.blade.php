@extends('template.admin')

@section('title','Administration of orders')

@section('breadcrumb')
    <ul>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ul>
@endsection

@section('content')
<div class="row">

    <span style="display:none;">{{route('admin.order.index')}}</span>

    <div class="col-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">{{ trans('admin.orders.titles.section') }}</h3>

            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">

                <table class="table table-head-fixed text-nowrap">

                    <thead>

                        <tr>

                            <td><strong>{{ trans('admin.orders.fields.id') }}</strong></td>
                            <th>{{ trans('admin.orders.fields.code') }}</th>
                            <td><strong>{{ trans('admin.orders.fields.total') }}</strong></td>
                            <th>{{ trans('admin.orders.fields.status') }}</th>
                            <td></td>
                            <td><strong>{{ trans('admin.orders.fields.user') }}</strong></td>
                            <td></td>
                            <td><strong>{{ trans('admin.orders.fields.created_at') }}</strong></td>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>{{$order->id}}</td>
                                <td>{{$order->code}}</td>
                                <td>COP {{ number_format($order->total, 0)}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->user_id}}</td>
                                <td>{{$order->name_receive}}</td>
                                <td>{{$order->surname}}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                
                            </tr>
                            
                        @endforeach

                    </tbody>
                    

                </table>
                
            </div>

        </div>

    </div>

</div>
@endsection
