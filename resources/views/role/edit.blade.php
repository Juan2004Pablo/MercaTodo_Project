@extends('template.admin')

@section('title','Edit role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <form action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container">

            <h3>Required data</h3>

            <div class="form-group">
                <input type="text" class="form-control"
                       id="name"
                       placeholder="Name"
                       name="name"
                       value="{{ old('name',$role->name) }}"
                >

            </div>

            <hr>
            <input class="btn btn-primary" type="submit" value="Save">


        </div>


    </form>
@endsection
