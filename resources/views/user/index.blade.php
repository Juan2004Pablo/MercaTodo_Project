
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

                    <div class="card-header"><h2>{{ trans('user.user.title.list_of_users') }}</h2></div>

                    <div class="card-body">

                        <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            
                            @if(Session::has('message'))

                                <p>{{ Session::get('message') }} </p>

                            @endif

                            <input type="file" name="file">

                            <button class="btn btn-secondary"> {{ trans('user.user.options.import') }} </button>

                        </form>

                        <a class="btn btn-Dark" href="{{ route('users.export') }}"> {{ trans('user.user.options.export') }} </a>

                        <br><br>

                        @include('custom.message')

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>{{ trans('user.user.fields.id') }}</th>
                                    <th>{{ trans('user.user.fields.name') }}</th>
                                    <th>{{ trans('user.user.fields.email') }}</th>
                                    <th>{{ trans('user.user.fields.identification') }}</th>
                                    <th>{{ trans('user.user.fields.role') }}</th>
                                    <th>{{ trans('user.user.fields.disable_at') }}</th>

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
                                        <td>{{ \Carbon\Carbon::parse($user->disable_at)->format('d/m/Y') }}</td>

                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('user.show',$user->id) }}">{{ trans('user.user.options.show') }}</a>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success" href="{{ route('user.edit',$user->id) }}">{{ trans('user.user.options.update') }}</a>
                                        </td>

                                        <td>
                                            
                                            @if($user->disable_at)
                                                <a class="btn btn-sm btn-warning " href="{{ route('user.toggle',$user) }}"><i class="fa fa-fw fa-eye"></i> Enable</a>
                                            @else
                                                <a class="btn btn-sm btn-danger " href="{{ route('user.toggle',$user) }}"><i class="fa fa-fw fa-eye"></i> Disable</a>
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
