@extends('template.admin')

@section('title','Administration of products')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div id="confirmdelete" class="row">

        <span style="display:none;" id="urlbase">{{route('admin.product.index')}}</span>

        @include('custom.modal_delete')

        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">{{ trans('admin.products.titles.section_of_products') }}</h3>

                    <br>

                    <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        @if(Session::has('message'))

                            <p>{{ Session::get('message') }} </p>

                        @endif

                        <input type="file" name="file">

                        <button class="btn btn-secondary"> {{ trans('admin.products.options.import') }} </button>

                        @include('custom.modal_search-product-admin')

                    </form>

                    <a class="btn btn-Dark" href="{{ route('products.export') }}"> {{ trans('admin.products.options.export') }} </a>

                </div>

                <div class="container">

                    @if($errors->any())

                        <div class="alert alert-danger" role="alert">

                            <ul>

                                @foreach($errors->all() as $message)

                                    <li>{{ $message }}</li>

                                @endforeach

                            </ul>
                        
                        </div>
                        
                    @endif

                    @if(session()->has('message'))

                        <div class="alert alert-primary" role="alert"> {{ session('message') }} </div>

                    @endif

                </div>

                <div class="card-body table-responsive p-0" style="height: 300px;">

                    <td><a class=" m-2 float-right btn btn-primary" href="{{ route('admin.product.create') }}"> {{ trans('admin.products.titles.create') }} </a></td>
                    
                    <table class="table table-head-fixed text-nowrap">

                        <thead>

                            <tr>

                                <th>{{ trans('admin.products.fields.id') }}</th>
                                <th>{{ trans('admin.products.fields.name') }}</th>
                                <th>{{ trans('admin.products.fields.category') }}</th>
                                <th>{{ trans('admin.products.fields.price') }}</th>
                                <th>{{ trans('admin.products.fields.quantity') }}</th>
                                <th colspan="3"></th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category_id}}</td>
                                    <td>COP {{ number_format($product->price,0) }}</td>
                                    <td>{{$product->quantity}}</td>
                                    
                                    <td><a class="btn btn-info" href="{{ route('admin.product.show',$product->id) }}">{{ trans('admin.products.options.show') }}</a></td>
                                    
                                    <td><a class="btn btn-success" href="{{ route('admin.product.edit',$product->id) }}">{{ trans('admin.products.options.update') }}</a></td>
                                    
                                    <td>

                                        @if($product->trashed())

                                            <form action=" {{ route('admin.product.restore', ['id'=> $product->id]) }}" method="POST">

                                                @csrf

                                                <button class="btn btn-success"> {{ trans('admin.products.options.active') }} </button>
                                            </form>

                                        @else

                                            <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger" onclick="return confirm('Do you want to disable this product?');"> {{ trans('admin.products.options.inactive') }} </button>

                                            </form>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    {{ $products->appends($_GET)->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
