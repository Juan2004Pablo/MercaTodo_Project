@extends('template.admin')

@section('title','Create role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    @include('custom.message')

    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <div class="container">

            <h3>Required data</h3>

            <div class="form-group">
                <input type="text" class="form-control"
                       id="name"
                       placeholder="Name"
                       name="name"
                       value="{{ old('name') }}"
                >

            </div>

            <div class="form-group">
                                        <textarea class="form-control" placeholder="Decription" name="decription"
                                                  id="decription"
                                                  rows="3">
                                            {{ old('description') }}
                                        </textarea>
            </div>

            <hr>
            <input class="btn btn-primary" type="submit" value="Save">


        </div>


    </form>


    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
