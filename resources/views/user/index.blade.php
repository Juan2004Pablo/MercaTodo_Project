
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

                        <br><br>
                        @include('custom.message')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role(s)</th>
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)

                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @isset($user->roles[0]->name)
                                            {{ $user->roles[0]->name }}
                                        @endisset

                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('user.edit',$user->id) }}">Update</a>
                                    </td>
                                    <td>
                                        @if($user->trashed())
                                            <form action=" {{ route('user.restore', ['id'=> $user->id]) }}"
                                                  method="POST">
                                                @csrf
                                                <button class="btn btn-success">
                                                    Activate
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                        onclick="return confirm('¿Desea eliminar este usuario?');">
                                                    Inactivate
                                                </button>
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
