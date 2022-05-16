@extends('layouts.master')

@section('content')

    <div class="container text-center">

        <div class="page">

            <div class="table-responsive">

                <h3>{{ trans('admin.cart.titles.shipping_information') }}</h3>

                <form action="{{ route('cart.Datesreceive')}}" method="POST">
                    
                    @csrf

                    <label for="name_receive" class="col-md-4 col-form-label text-center">{{ __('Name') }}</label>

                    <input id="name_receive" type="text" class="form-control" name="name_receive" value="{{ Auth::user()->name }}" required autocomplete="name_receive" autofocus minlength="3" maxlength="30">

                    <label for="surname" class="col-md-4 col-form-label text-center">{{ __('Surname') }}</label>

                    <input id="surname" type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" required autocomplete="surname" autofocus minlength="4" maxlength="30">

                    <label for="address" class="col-md-4 col-form-label text-centert">{{ __('Address') }}</label>
                    
                    <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required autocomplete="address" autofocus minlength="15" maxlength="50">

                    <label for="phone" class="col-md-4 col-form-label text-centert">{{ __('Phone') }}</label>
                    
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" autofocus minlength="7" maxlength="10">

                    <br>

                    <div class="table-responsive">

                        <h3>{{ trans('admin.cart.titles.order_detail') }}</h3>

                        <table class="table table-striped table-hover table-bordered">

                            <tr>

                                <th>{{ trans('admin.cart.fields.product') }}</th>
                                <th>{{ trans('admin.cart.fields.price') }}</th>
                                <th>{{ trans('admin.cart.fields.quantity') }}</th>
                                <th>{{ trans('admin.cart.fields.subtotal') }}</th>
                            
                            </tr>

                            @foreach($cart->details as $item)

                                <tr>

                                    <td>{{ $item->products->name}}</td>
                                    <td>COP {{ number_format($item->products->price,0) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>COP {{ number_format($item->products->price * $item->quantity,0) }}</td>
                                
                                </tr>

                            @endforeach

                        </table>

                        <p>

                            <a href="{{ route('cart.show') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> Back </a>

                            <input class="btn btn-primary" type="submit" value="Save">

                        </p>

                    </div>

                </form>

            </div>

        </div>

    </div>

@stop
