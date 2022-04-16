@extends('layouts.master')

@section('content')
<div class="container text-center">
    <div class="page-header">
        <h1><i class="fas fa-money-check-alt"></i>Payment status</h1>

        <span style="display:none;" id="urlbase">{{route('pay.show')}}</span>
        <div class="table-responsive">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Total</th>


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
                <a href="{{ route('pay.retryPayment', $payment->reference) }}" class="btn btn-info">
                    Retry payment
                </a>
            </p>
            @endif
    </div>
</div>
@endsection
