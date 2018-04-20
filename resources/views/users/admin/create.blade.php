
@extends('layouts.admin')


@section('content')






<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
    <!-- Page Header -->
    <div class="page-header">
     <h1 class="page-title">Create New User</h1>  <ol class="breadcrumb">
        <li><a href="../index.html">User Accounts</a></li>
        <li class="active">Edit User</li>
      </ol>

    </div>
    <!-- End Page Header -->
    <!-- Page Content -->
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">



    @include('common.errors')

    <form action="/admin/user" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Type</label>

            <div class="col-sm-6">
                {{ Form::select('type', ['admin' => 'Admin', 'user' => 'User'], old('type'), ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Region</label>

            <div class="col-sm-6">
                {{ Form::select('region', App\User::$regions, old('region'), ['placeholder' => '', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-6">
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="col-sm-3 control-label">Confirm Password</label>

            <div class="col-sm-6">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a href="{{ url('admin/users') }}" class="btn btn-default">
                    Cancel
                </a>
                <button type="submit" class="btn btn-default btn-primary pull-right">
                    <i class="fa fa-btn fa-plus"></i> Add User
                </button>
            </div>
        </div>
    </form>

        </div>
      </div>
    </div>
    <!-- End Page Content -->
  </div>








@endsection
