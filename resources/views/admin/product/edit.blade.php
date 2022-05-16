@extends('template.admin')

@section('title', 'Edit Product')

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

                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">{{ trans('admin.products.titles.dates') }}</h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>{{ trans('admin.products.fields.name') }}</label>

                                    <input class="form-control" type="text" id="name" name="name" value="{{ $product->name }}" minlength="3" maxlength="50" required>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>{{ trans('admin.products.fields.category') }}</label>

                                    <select name="category_id" class="form-control select2" style="width: 100%;">

                                        <option selected="selected">{{ $product->category->name }}</option>

                                    </select>

                                    <label>{{ trans('admin.products.fields.quantity') }}</label>

                                    <input class="form-control" type="number" id="quantity" name="quantity" value="{{ $product->quantity }}">
                                
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

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ trans('admin.products.titles.cop') }}</span>
                                        </div>

                                        <input class="form-control" type="number" id="price" name="price" min="0" step=".01" value="{{ $product->price }}">
                                    
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
                                    <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card card-warning">

                    <div class="card-header">
                        <h3 class="card-title">{{ trans('admin.products.fields.image') }}</h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label for="images">{{ trans('admin.products.titles.addImage') }}</label>

                            <input type="file" class="form-control-file" name="images[]" id="images[]" multiple accept="image/products/*">

                        </div>

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

                                    <a href="{{ $image->url }}">
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

                                    <select name="status" class="form-control select2" style="width: 100%;">
                                        @foreach($statusProducts as $status )

                                            @if ($status == $product->status)
                                            
                                                <option value="{{ $status }}" selected="selected">{{ $status }}</option>

                                            @else

                                                <option value="{{ $status }}">{{ $status }}</option>

                                            @endif

                                        @endforeach

                                    </select>

                                </div>

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
                                    <input type="submit" value="Save" class="btn btn-primary">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </form>

    </div>
@endsection
