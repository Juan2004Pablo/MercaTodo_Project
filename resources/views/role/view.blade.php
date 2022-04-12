@extends('plantilla.admin')

@section('title','Show role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

            @include('custom.message')


                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="container">

                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="name"
                                           placeholder="Name"
                                           name="name"
                                           value="{{ old('name',$role->name) }}"
                                           readonly
                                    >

                                </div>

                                <div class="form-group">
                                    <textarea readonly class="form-control" placeholder="Description" name="description"
                                              id="description"
                                              rows="3">{{old('description', $role->description)}}</textarea>
                                </div>

                                <hr>

                                <a class="btn btn-success" href="{{route('role.edit',$role->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('role.index')}}">Back</a>


                            </div>


                        </form>


                    </div>
                </div>

@endsection
