@extends('layouts.app')

@section('template_title')
    User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User administration panel') }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Email</th>
                                        <th>Disable</th>
										<th>Role</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
                                            <td>{{ $user->disable_at }}</td>
											<td>{{ $user->role }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('users.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                <a class="btn btn-sm btn-success"  href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> Update</a>
                                                @if($user->disable_at)
                                                <a class="btn btn-sm btn-warning " href="{{ route('admin.users.toggle',$user) }}"><i class="fa fa-fw fa-eye"></i> Enable</a>
                                                @else
                                                <a class="btn btn-sm btn-warning " href="{{ route('admin.users.toggle',$user) }}"><i class="fa fa-fw fa-eye"></i> Disable</a>
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
        </div>
    </div>
@endsection