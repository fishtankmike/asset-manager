@extends('layouts.admin')


@section('content')


<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
    <!-- Page Header -->
    <div class="page-header">     <h1 class="page-title">All Users</h1>
      <ol class="breadcrumb">
        <li>User Accounts</li>
        <li class="active">All Users</li>
      </ol>

    </div>
    <!-- End Page Header -->
    <!-- Page Content -->
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">

   <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Region</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created On</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) > 0)
            @foreach ($users as $user)
            <tr>
                <td>{{ ucfirst($user->type) }}</td>
                <td>{{ strtoupper($user->region) }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                <td class="text-right">
                    <!-- <a href="{{ url('user', [$user->id]) }}" class="btn btn-default">View</a> -->
                    <a href="{{ url('/admin/user', [$user->id, 'edit']) }}" class="btn btn-default">Edit</a>
                    @if ($user->id != Auth::user()->id)
                    <form action="{{ url('admin/user/' . $user->id) }}" method="POST" class="visible-xs-inline visible-sm-inline visible-md-inline visible-lg-inline">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    {!! $users->links() !!}

        </div>
      </div>
    </div>
    <!-- End Page Content -->
  </div>








@endsection
