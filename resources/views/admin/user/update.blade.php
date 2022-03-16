@extends('layouts.app')

@section('template_title')
    Update User
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="name" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}">
                                    </div>
                                    <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->email }}">
                                    </div>
                                    <label for="exampleFormControlInput1" class="form-label">Role</label>
                                    <select class="form-select" aria-label="Role">
                                    <option selected></option>
                                    <option value="1">client</option>
                                    <option value="2">admin</option>
                                    </select>
                                    <br>
                                    <div class="row mb-3">
                                    <div class="col d-grid">
                                    <button class="btn btn-sm btn-success " type="submit"><i class="fa fa-fw fa-edit"></i>{{ trans('Save') }}</button>
                                    </div>
                                    <div class="col d-grid">
                                        <a href="{{ route('users.index') }}" class="btn btn-danger">{{ trans('Cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection