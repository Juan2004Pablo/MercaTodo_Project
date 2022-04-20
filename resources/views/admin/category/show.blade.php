@extends('template.admin')

@section('title','Show category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ trans('admin.categories.titles.title') }}</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div id="apicategory">
    <form>
        @csrf
        <span style="display:none;" id="edit">{{$edit}}</span>
        <span style="display:none;" id="nametemp">{{$cat->name}}</span>

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">{{ trans('admin.categories.titles.adminCategory') }}</h3>

                <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>

                </div>

            </div>

            <div class="card-body">

                <div class="form-group">

                    <label for="name">{{ trans('admin.categories.fields.name') }}</label>
                    <input v-model="name"
                        @blur="getCategory"
                        @focus="div_appear= false"
                        readonly
                    class="form-control" type="text" name="name" id="name" value="{{ $cat->name }}" readonly>

                    <label for="description">{{ trans('admin.categories.fields.description') }}</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" readonly>{{ $cat ->description}}</textarea>

                </div>

            </div>

            <div class="card-footer">

                <a class="btn btn-danger" href="{{ route('cancel','admin.category.index') }}">{{ trans('admin.categories.options.cancel') }}</a>

                <a class="btn btn-success float-right" href="{{ route('admin.category.edit',$cat->id) }}">{{ trans('admin.categories.options.update') }}</a>

            </div>

        </div>

    </form>

</div>
@endsection
