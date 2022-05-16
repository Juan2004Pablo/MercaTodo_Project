@extends('template.admin')

@section('title', 'Show Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">{{ trans('admin.products.titles.title') }}</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div id="product">

        <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <section class="content">

                <div class="container-fluid">

                    <div class="card card-info">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('admin.products.titles.dates') }}</h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>{{ trans('admin.products.fields.name') }}</label>

                                        <div class="input-group-text">{{ $product->name }}</div>

                                        <label>{{ trans('admin.products.fields.quantity') }}</label>
                                        
                                        <div class="input-group-text" type="number">{{ $product->quantity }}</div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>{{ trans('admin.products.fields.category') }}</label>

                                        <div class="input-group-text">{{ $product->category->name }}</div>

                                        <label>{{ trans('admin.products.fields.created_at') }}</label>

                                        <div class="input-group-text" type="number">{{ $product->created_at }}</div>
                                    
                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </div>

                    <div class="card card-success">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('admin.products.titles.pricing') }}</h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>{{ trans('admin.products.fields.price') }}</label>

                                        <div class="input-group">

                                            <div class="input-group-text">{{ trans('admin.products.titles.cop') }}</div>

                                            <div class="input-group-text" id="price" name="price" min="1" type="number">{{ number_format($product->price, 0) }}</div>
                                        
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('admin.products.titles.descriptions') }}</h3>
                                </div>

                                <div class="card-body">

                                    <div class="form-group">

                                        <label>{{ trans('admin.products.fields.description') }}</label>

                                        <textarea readonly class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card card-warning">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('admin.products.fields.image') }}</h3>
                        </div>

                    </div>

                    <div class="card card-primary">
                        
                        <div class="card-body">

                            <div class="row">

                                @foreach ($product->images as $image)

                                    <div class="col-sm-2">

                                        <a href="{{ $image->url }}" data-toggle="lightbox" data-title="Id:{{ $image->id }}" data-gallery="gallery">
                                            <img src="{{ $image->url }}" class="img-fluid mb-2"/>
                                        </a>

                                        <br>
                                        
                                        <a style="display: none" href="{{ $image->url }}">
                                            <i class="fas fa-trash-alt" style="color:red"></i>
                                        </a>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    <div class="card card-danger">
                        
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('admin.products.fields.status') }}</h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>{{ trans('admin.products.fields.status') }}</label>

                                        <div class="input-group-text">{{ $product->status }}</div>

                                    </div>

                                </div>

                            </div>
                        
                        </div>

                        <div class="card card-primary">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <a class="btn btn-danger" href="{{ route('cancel','admin.product.index') }}">{{ trans('admin.products.options.cancel') }}</a>

                                            <a class="btn btn-success" href="{{ route('admin.product.edit',$product->id) }}">{{ trans('admin.products.options.update') }}</a>
                                        
                                        </div>

                                    </div>

                                </div>
                            
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </form>

    </div>
@endsection
