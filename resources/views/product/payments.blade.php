@extends('layouts.master')

@section('content')

    <div class="container text-center">

        <div class="page-header">

            <h1><i class="fas fa-file-invoice-dollar"></i>{{ trans('admin.payment.titles.history') }}</h1>

            <br>

            <div class="table-responsive">

                <table class="table table-hover table-bordered">

                    <thead>

                        <tr>

                            <th>{{ trans('admin.payment.fields.date') }}</th>
                            <th>{{ trans('admin.payment.fields.status') }}</th>
                            <th>{{ trans('admin.payment.fields.method') }}</th>
                            <th>{{ trans('admin.payment.fields.name') }}</th>
                            <th>{{ trans('admin.payment.fields.surname') }}</th>
                            <th>{{ trans('admin.payment.fields.total') }}</th>
                            <th> </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($Payments as $pay)

                            <tr>
                                <th>{{ $pay->created_at }}</th>
                                <th>{{ $pay->status }}</th>
                                <th>{{ $pay->payment_method }}</th>
                                <th>{{ $pay->name }}</th>
                                <th>{{ $pay->surname }}</th>
                                <th>COP {{ number_format($pay->order_total,0) }}</th>

                                @if($pay->status == 'REJECTED')

                                    <td>
                                        <a href="{{ route('pay.retryPayment', $pay->reference) }}" class="btn btn-info">{{ trans('admin.payment.options.retry') }}</a>
                                    </td>

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    
    </div>

@endsection
