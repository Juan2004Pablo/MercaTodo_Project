@extends('layouts.master')

@section('content')
    <div class="container">

        @include('custom.modal_search-product')

        <div class="container">

            <div class="album py-5 bg-light">

                <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">

                    <h1 class="display-4">{{ trans('admin.products.titles.title') }}</h1>

                </div>

                <div class="container">

                    <div class="row">

                        @foreach($products as $item)

                            @if($item->quantity>0)

                                <div class="col-md-4">

                                    <div class="card mb-4 shadow-sm">

                                        <img class="bd-placeholder-img" src="{{ $item->images->random()->url }}" width="267" height="225" title="Products">

                                        <div class="card-body">

                                            <p class="text-center" style="font-weight: 700; font-size: 1.25rem; text-transform: uppercase;">{{ $item->name }} </p>
                                            
                                            <p class="card-subtitle mb-2 text-muted">{{ $item->description }}</p>
                                            
                                            <p class="card-text">COP {{ number_format($item->price,0) }}</p>
                                            
                                            <p class="card-text">Available: {{ $item->quantity }}</p>

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <a class="btn btn-sm btn-dark" href="{{ route('product.show',$item->id) }}"><i class="far fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-dark" href="{{ route('cart.add',$item->id) }}"><i class="fas fa-cart-plus"></i></a>
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        {{ $products->appends($_GET)->links() }}

    </div>
    
@endsection
