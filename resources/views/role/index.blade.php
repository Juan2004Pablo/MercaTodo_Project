@extends('template.admin')

@section('title','Administration of roles')

@section('breadcrumb')
<ul>
    <li class="breadcrumb-item active">@yield('title')</li>
</ul>
@endsection

@section('content')

    <div id="confirmdelete" class="row">

        @include('custom.modal_delete')

        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <div class="card-header">
                        
                        <h2>{{ trans('user.role.title.list_of_roles') }}</h2>
                    
                    </div>

                    <div class="card-body">

                        <form action="{{ route('roles.import') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            
                            @if(Session::has('message'))

                                <p>{{ Session::get('message') }} </p>

                            @endif

                            <input type="file" name="file">

                            <button class="btn btn-secondary"> {{ trans('user.role.options.import') }} </button>

                        </form>

                        <a class="float-left btn btn-Dark" href="{{ route('roles.export') }}"> {{ trans('user.role.options.export') }} </a>

                        <a href="{{route('role.create')}}" class="btn btn-primary float-right"> {{ trans('user.role.options.create') }} </a>

                        <br><br>

                        @include('custom.message')

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th scope="col">{{ trans('user.role.fields.id') }}</th>
                                    <th scope="col">{{ trans('user.role.fields.name') }}</th>
                                    <th colspan="3"></th>
                                    
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($roles as $role)

                                    <tr>

                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>

                                        <td>
                                            <a class="btn btn-info" href="{{ route('role.show',$role->id) }}">{{ trans('user.role.options.show') }}</a>
                                        </td>

                                        <td>
                                            <a class="btn btn-success" href="{{ route('role.edit',$role->id) }}">{{ trans('user.role.options.update') }}</a>
                                        </td>

                                        <td>
                                            <form action="{{ route('role.destroy',$role->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger">{{ trans('user.role.options.delete') }}</button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        {{ $roles->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
