@extends('template.admin')

@section('title','Update role')

@section('breadcrumb')
<ul>
    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">{{ trans('user.role.title.title') }}</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ul>
@endsection

@section('content')

    <form action="{{ route('role.update', $role->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="container">

            <h3>{{ trans('user.role.title.name') }}</h3>

            <div class="form-group">

                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $role->name }}">

            </div>

            <h3>{{ trans('user.role.title.permission_list') }}</h3>

                @foreach($permissions as $permission)

                    <div class="custom-control custom-checkbox">

                        <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" name="permission[]"

                            @if(is_array(old('permission')) && in_array("$permission->id", old("permission")))
                                
                                checked

                            @elseif(is_array($roleHasPermissions) && in_array("$permission->id", $roleHasPermissions))

                                checked

                            @endif

                        >

                        <label class="custom-control-label" for="permission_{{ $permission->id }}"> {{ $permission->id }} - {{ $permission->name }} </label>
                    
                    </div>

                @endforeach

            <hr>

            <input class="btn btn-primary" type="submit" value="Save">

            <a class="btn btn-danger" href="{{route('role.index')}}">{{ trans('user.role.options.back') }}</a>

        </div>

    </form>

@endsection
