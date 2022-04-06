@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? 'Show User' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                        <div class="form-group">
                            <strong>Disable:</strong>
                            {{ $user->disable_at }}
                        </div>
                        <div class="form-group">
                            <strong>Role:</strong>
                            {{ $user->role }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
            @include('custom.message')


            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="container">

                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               id="name"
                               placeholder="Name"
                               name="name"
                               value="{{ old('name',$user->name) }}"
                               disabled
                        >
                    </div>

                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               id="surname"
                               placeholder="Surname"
                               name="surname"
                               value="{{ old('Surname',$user->surname) }}"
                               disabled
                        >
                    </div>
                    <div class="form-group">
                        <input type="number"
                               class="form-control"
                               id="identification"
                               placeholder="Identification"
                               name="identification"
                               value="{{ old('Identification',$user->identification) }}"
                               disabled
                        >
                    </div>
                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               id="address"
                               placeholder="Address"
                               name="address"
                               value="{{ old('Address',$user->address) }}"
                               disabled
                        >
                    </div>
                    <div class="form-group">
                        <input type="number"
                               class="form-control"
                               id="phone"
                               placeholder="Phone"
                               name="phone"
                               value="{{ old('Phone',$user->phone) }}"
                               disabled
                        >
                    </div>


                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               id="email"
                               placeholder="email"
                               name="email"
                               value="{{ old('email',$user->email) }}"
                               disabled
                        >
                    </div>

                    <div class="form-group">
                        <select disabled class="form-control" name="roles" id="roles">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        @isset($user->roles[0]->name)
                                        @if($role->name == $user->roles[0]->name)
                                        selected
                                    @endif
                                    @endisset


                                >{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>

                    <a class="btn btn-success" href="{{route('user.edit',$user->id)}}">Edit</a>
                    <a class="btn btn-danger" href="{{route('user.index')}}">Back</a>


                </div>


            </form>


        </div>
    </div>
@endsection