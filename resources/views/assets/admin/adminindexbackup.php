@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-header">
     
            <i class="fa fa-btn fa-plus"></i> Add New Asset
     
        <h1>Assets</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Region</th>
                <th>Created On</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (count($assets) > 0)
            @foreach ($assets as $asset)
            <tr>
                <td>{{ $asset->category->name_with_parent }}</td>
                <td>{{ $asset->name }}</td>
                <td>{{ strtoupper($asset->region) }}</td>
                <td>{{ $asset->created_at->format('d-m-Y H:i') }}</td>
                <td class="text-right">
                    <!-- <a href="{{ url('user', [$asset->id]) }}" class="btn btn-default">View</a> -->
                    <a href="{{ url('/admin/asset', [$asset->id, 'edit']) }}" class="btn btn-default">Edit</a>
                    <form action="{{ url('admin/asset/' . $asset->id) }}" method="POST" class="visible-xs-inline visible-sm-inline visible-md-inline visible-lg-inline">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    {!! $assets->links() !!}
</div>
@endsection
