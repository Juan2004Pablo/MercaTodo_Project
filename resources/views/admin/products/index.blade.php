@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card card-default">
            <div class="card-header">{{ trans('admin.products.titles.adminProduct') }} - <a href="{{ route('products.create') }}"
                                                                                    class="btn btn-primary">{{ trans('Create') }}</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{ trans('admin.products.fields.name') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.price') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.quantity') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.disable') }}</th>
                        <th scope="col">{{ trans('admin.products.fields.images') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('products.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->disable_at }}</td>
                            <td>{{ $product->images_count }}</td>

                            <td>
                                <a class="btn btn-sm btn-success " href="{{ route('products.edit',$product->id) }}"><i class="fa fa-fw fa-edit"></i> Update</a>
                                @if($product->disable_at)
                                <a class="btn btn-sm btn-warning " href="{{ route('admin.products.toggle',$product) }}"><i class="fa fa-fw fa-eye"></i> Enable</a>
                                @else
                                <a class="btn btn-sm btn-warning " href="{{ route('admin.products.toggle',$product) }}"><i class="fa fa-fw fa-eye"></i> Disable</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection