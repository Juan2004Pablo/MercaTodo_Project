@extends('layouts.master')

@section('content')
<div class="container text-center">

    <div class="page-header">

        <h1><i class="fas fa-money-check-alt"></i>{{ trans('admin.payment.titles.status') }}</h1>

        <span style="display:none;" id="urlbase">{{route('pay.show')}}</span>

        <div class="table-responsive">

            <table class="table table-striped table-hover table-bordered">

                <thead>

                    <tr>

                        <th>{{ trans('admin.payment.fields.status') }}</th>
                        <th>{{ trans('admin.payment.fields.method') }}</th>
                        <th>{{ trans('admin.payment.fields.name') }}</th>
                        <th>{{ trans('admin.payment.fields.surname') }}</th>
                        <th>{{ trans('admin.payment.fields.total') }}</th>

                    </tr>

                </thead>

                <tbody>

                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->name }}</td>
                    <td>{{ $payment->surname }}</td>
                    <td>COP {{ number_format($payment->order_total,0) }}</td>

                </tbody>

            </table>

            @if($payment->status== 'REJECTED')

                <p>
                    <a href="{{ route('pay.retryPayment', $payment->reference) }}" class="btn btn-info">{{ trans('admin.payment.options.retry') }}</a>
                </p>
            
            @endif

        </div>

    </div>

</div>
@endsection
