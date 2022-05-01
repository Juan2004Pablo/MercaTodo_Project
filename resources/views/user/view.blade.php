@extends('template.admin')

@section('title','Show user')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            @include('custom.message')

            <form action="{{ route('user.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="container">

                    <div class="form-group">

                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $user->name }}" disabled>
                            
                        <br>

                        <input type="text" class="form-control" id="surname" placeholder="Surname" name="surname" value="{{ $user->surname }}" disabled>
                            
                        <br>
                            
                        <input type="text" class="form-control" id="surname" placeholder="Surname" name="surname" value="{{ $user->surname }}" disabled>
                            
                        <br>
                            
                        <input type="number" class="form-control" id="identification" placeholder="Identification" name="identification" value="{{ $user->identification }}" disabled>
                            
                        <br>
                        
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{ old('Address',$user->address) }}" disabled >
                            
                        <br>
                            
                        <input type="number" class="form-control" id="phone" placeholder="Phone" name="phone" value="{{ old('Phone',$user->phone) }}" disabled >
                            
                        <br>
                            
                        <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{ $user->email }}" disabled >
                            
                        <br>
                            
                        <input type="text" class="form-control" id="role" placeholder="Role" name="role" value="{{ $user->roles[0]->name }}" disabled >
                            
                        <br>
                            
                        <input type="text" class="form-control" id="created" placeholder="Created At" name="created" value="Created at: {{ $user->created_at }}" disabled >

                        <br>
                            
                        <input type="text" class="form-control" id="updated" placeholder="Updated At" name="updated" value="Updated at: {{ $user->updated_at }}" disabled >

                        <br>
                            
                        <input type="text" class="form-control" id="disable" placeholder="Disable At" name="disabled" value="Disable at: {{ $user->disable_at }}" disabled >
                        
                    </div>

                    <hr>

                    <a class="btn btn-success" href="{{route('user.edit',$user->id)}}">Update</a>

                    <a class="btn btn-danger" href="{{route('user.index')}}">Back</a>

                </div>

            </form>

        </div>

    </div>

@endsection
