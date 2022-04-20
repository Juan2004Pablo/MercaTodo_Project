@extends('template.admin')

@section('title','Administration of details')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="row">

    <span style="display:none;">{{route('admin.detail.index')}}</span>

    <div class="col-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">{{ trans('admin.details.titles.section') }}</h3>

                <div class="card-tools">

                    <form>

                        <div class="input-group input-group-sm" style="width: 150px;">

                            <input type="text" name="name" class="form-control float-right" placeholder="Search" value="{{ request()->get('name') }}" >

                            <div class="input-group-append">

                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">

                <table class="table table-head-fixed text-nowrap">

                    <thead>

                        <tr>

                            <th>{{ trans('admin.details.fields.id') }}</th>
                            <th>{{ trans('admin.details.fields.product') }}</th>
                            <th>{{ trans('admin.details.fields.quantity') }}</th>
                            <th>{{ trans('admin.details.fields.price') }}</th>
                            <th>{{ trans('admin.details.fields.subtotal') }}</th>
                            <th colspan="3"></th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($details as $detail)

                            <tr>

                                <td>{{$detail->id}}</td>
                                <td>{{$detail->products->name}}</td>
                                <td>{{$detail->quantity}}</td>
                                <td>{{$detail->products->price}}</td>
                                <td>{{$detail->products->price * $detail->quantity}}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
            
        </div>

    </div>
</div>
@endsection
