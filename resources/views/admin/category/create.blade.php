@extends('template.admin')

@section('title','Create category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ trans('admin.categories.titles.title') }}</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div id="apicategory">

    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf

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

                    <input class="form-control" type="text" name="name" id="name" maxlength="20">

                    <br>

                    <label for="description">{{ trans('admin.categories.fields.description') }}</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" minlength="15"></textarea>

                </div>

            </div>

            <div class="card-footer">

                <a class="btn btn-danger" href="{{ route('cancel','admin.category.index') }}">{{ trans('admin.categories.options.cancel') }}</a>

                <input
                    type="submit" value="Save" class="btn btn-primary">

            </div>

        </div>

    </form>

</div>
@endsection
