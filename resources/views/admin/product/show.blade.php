@extends('plantilla.admin')

@section('title', 'Show Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Products</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

<script>
    window.data = {
        edit: 'Si',
        dat: {
            "name": "{{$product->name}}",
        }
    }

    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });
</script>


@section('content')

    <div id="apiproduct">

        <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Product dates</h3>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Name</label>
                                        <input

                                            readonly
                                            v-model="name"
                                            @blur="getProduct"
                                            @focus="div_appear= false"

                                            class="form-control" type="text" id="name" name="name">

                                        
                                        <br v-if="div_appear">

                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>category</label>
                                        <select disabled name="category_id" class="form-control select2"
                                                style="width: 100%;">
                                                    <option selected="selected">{{ $product->category->name }}</option>
                                        </select>
                                        <label>Quantity</label>
                                        <input readonly class="form-control" type="number" id="quantity" name="quantity"
                                               value="{{ $product->quantity }}">
                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </div>

                    <!-- /.card -->

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pricing Section</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label>Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input readonly class="form-control" type="number" id="price" name="price"
                                                   min="0" step=".01"
                                                   value="{{ $product->price }}">
                                        </div>

                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product descriptions</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Description:</label>

                                        <textarea readonly class="form-control" name="description" id="description"
                                                  rows="5">
                                        {{ $product->description }}
                                    </textarea>

                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col-md-6 -->

                    </div>
                    <!-- /.row -->

                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                Galery of images
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                @foreach ($product->images as $image)
                                    <div class="col-sm-2">
                                        <a href="{{ $image->url }}" data-toggle="lightbox"
                                           data-title="Id:{{ $image->id }}" data-gallery="gallery">
                                            <img src="{{ $image->url }}" class="img-fluid mb-2"/>
                                        </a>
                                        <br>
                                        <a style="display: none" href="{{ $image->url }}">
                                            <i class="fas fa-trash-alt" style="color:red"></i>
                                        </a>
                                    </div>

                                    {{ $image->id }}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Administration</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Status</label>
                                        <select disabled name="status" class="form-control select2"
                                                style="width: 100%;">
                                            @foreach($statusProducts as $status )

                                                @if ($status == $product->status)
                                                    <option value="{{ $status }}"
                                                            selected="selected">{{ $status }}</option>
                                                @else
                                                    <option value="{{ $status }}">{{ $status }}</option>
                                                @endif
                                            @endforeach
                                        </select>


                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <a class="btn btn-danger" href="{{ route('cancel','admin.product.index') }}">cancel</a>

                                        <a class="btn btn-outline-success "
                                           href="{{ route('admin.product.edit',$product->id) }}">Edit</a>
                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                        </div>

                    </div>
                    <!-- /.card -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </form>

    </div>

@endsection
