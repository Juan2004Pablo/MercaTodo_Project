
@extends('template.admin')

@section('title','Administration of users')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div id="confirmdelete" class="row">

        @include('custom.modal_delete')

        <div class="col-12">

            <div class="card">

                <div class="card-header">

                    <div class="card-header"><h2>List of Users</h2></div>

                    <div class="card-body">

                        <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            
                            @if(Session::has('message'))

                                <p>{{ Session::get('message') }} </p>

                            @endif

                            <input type="file" name="file">

                            <button class="btn btn-secondary"> Import </button>

                        </form>

                        <a class="btn btn-Dark" href="{{ route('users.export') }}"> Export </a>

                        <br><br>

                        @include('custom.message')

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Identification</th>
                                    <th>Role</th>
                                    <th>Disable At</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($users as $user)

                                    <tr>

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->identification }}</td>
                                        <td>{{ $user->roles[0]->name}}</td>
                                        <td>{{ $user->disable_at }}</td>

                                        <td>
                                            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
                                        </td>

                                        <td>
                                            <a class="btn btn-success" href="{{ route('user.edit',$user->id) }}">Update</a>
                                        </td>

                                        <td>
                                            
                                            @if($user->trashed())

                                                <form action=" {{ route('user.restore', ['id'=> $user->id]) }}" method="POST">
                                                    @csrf

                                                    <button class="btn btn-success"> Activate </button>

                                                </form>

                                            @else
                                            
                                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger" onclick="return confirm('¿Desea eliminar este usuario?');"> Inactivate </button>

                                                </form>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        {{ $users->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>
    
@endsection
