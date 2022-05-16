@extends('template.admin')

@section('title','Administration of categories')

@section('breadcrumb')
    <ul>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ul>
@endsection

@section('content')
    <div id="confirmdelete" class="row">

        <span style="display:none;" id="urlbase">{{route('admin.category.index')}}</span>

        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">{{ trans('admin.categories.titles.section') }}</h3>

                </div>

                <div class="card-body table-responsive p-0" style="height: 300px;">

                    <br>

                    <form action="{{ route('categories.import') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        
                        @if(Session::has('message'))

                            <p>{{ Session::get('message') }} </p>

                        @endif

                        <input type="file" class="ml-2" name="file">

                        <button class="btn btn-secondary">{{ trans('admin.categories.options.import') }} </button>

                    </form>

                    <a class="m-2 float-left btn btn-Dark" href="{{ route('categories.export') }}">{{ trans('admin.categories.options.export') }} </a>

                    <a class="m-2 float-right btn btn-primary" href="{{ route('admin.category.create') }}">{{ trans('admin.categories.titles.create') }}</a>
                    
                    <table class="table table-head-fixed text-nowrap">

                        <thead>

                            <tr>

                                <th>{{ trans('admin.categories.fields.id') }}</th>
                                <th>{{ trans('admin.categories.fields.name') }}</th>
                                <th>{{ trans('admin.categories.fields.description') }}</th>
                                <th colspan="3"></th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($categories as $category)

                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>

                            
                                <td><a class="btn btn-info"
                                href="{{ route('admin.category.show',$category->id) }}">{{ trans('admin.categories.options.show') }}</a></td>
                            
                                <td><a class="btn btn-success"
                                href="{{ route('admin.category.edit',$category->id) }}">{{ trans('admin.categories.options.update') }}</a></td>
                            
                                <td>
                                    @if($category->trashed())

                                        <form action=" {{ route('admin.category.restore', ['id'=> $category->id]) }}" method="POST">
                                            @csrf

                                            <button class="btn btn-success">
                                                {{ trans('admin.categories.options.activate') }}
                                            </button>

                                        </form>

                                    @else

                                        <form action="{{ route('admin.category.destroy',$category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger"
                                                onclick="return confirm('¿do you want to disable this category?');">
                                                {{ trans('admin.categories.options.inactive') }}
                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
