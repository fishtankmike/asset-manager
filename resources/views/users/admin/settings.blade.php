@extends('layouts.innergrey')


@section('content')


<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">

       @include('common.flash')

      <div class="page-header">

           <h1 class="page-title">Edit My Account</h1>
      <div class="page-header-actions">
        <a href="https://nonleaguenetwork.co.uk/admin/user/create" type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Add New">
          <i class="icon wb-plus" aria-hidden="true"></i>
        </a>

           <button type="button" value="Refresh Page" onclick="window.location.reload()" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Refresh">
          <i class="icon wb-refresh" aria-hidden="true"></i>
        </button>

        <a type="button" href="https://nonleaguenetwork.co.uk/logout" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Logout">
          <i class="icon wb-power" aria-hidden="true"></i>
        </a>
      </div>
      <ol class="breadcrumb">
        <li>My Account</li>
        <li class="active">Edit</li>
      </ol>
      <div class="page-header-actions">

      </div>
    </div>
    <div class="page-content">

      <div class="panel">
        <div class="panel-heading">



        </div>
        <div class="panel-body">



    @include('common.errors')

    <form action="/settings" method="POST" class="form-horizontal">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
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
                <a href="{{ url('assets') }}" class="btn btn-default">
                    Cancel
                </a>
                <button type="submit" class="btn btn-default btn-primary pull-right">
                    <i class="fa fa-btn fa-pencil"></i> Save
                </button>
            </div>
        </div>
    </form>

        </div>

      </div>
    </div>
  </div>









@endsection
