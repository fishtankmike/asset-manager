@extends('layouts.admin')

@section('content')

<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
    <!-- Page Header -->
    <div class="page-header"> <h1 class="page-title">View Assets</h1>
      <ol class="breadcrumb">
        <li>Assets</li>
      </ol>

      <div class="page-header-actions">
        <form>
          <div class="input-search input-search-dark">
            <i class="input-search-icon wb-search" aria-hidden="true"></i>
            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ old('search', Request::get('search')) }}">
          </div>
        </form>
      </div>
    </div>
    <!-- End Page Header -->
    <!-- Page Content -->
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">


  <table class="table table-striped">
        <thead>
            <tr>
                   <th>Name</th>
                <th class="hide-me">Category</th>

                <th class="hide-me">Region</th>
                <th class="hide-me">Created On</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (count($assets) > 0)
            @foreach ($assets as $asset)
            <tr>

                <td>{{ $asset->name }}</td>
                  <td class="hide-me">{{ $asset->category_names }}</td>
                <td class="hide-me">{{ strtoupper($asset->region) }}</td>

                <td class="hide-me">{{ $asset->created_at->format('d-m-Y H:i') }}</td>
                <td class="text-right">
                    <!-- <a href="{{ url('user', [$asset->id]) }}" class="btn btn-default">View</a> -->
                  @if (count($asset->assetfiles))
                            @foreach ($asset->assetfiles as $file)

                               <a href="{{ url('admin/asset-file/' . $file->id) }}"  type="button" class="btn btn-animate btn-animate-side btn-success">
                    <span><i class="icon wb-download" aria-hidden="true"></i>Download</span>
                  </a>
                            @endforeach
                        @else

                        @endif  <a href="{{ url('/admin/asset', [$asset->id, 'edit']) }}" class="btn btn-default">Edit</a>
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

        </div>
      </div>
    </div>
    <!-- End Page Content -->
  </div>








@endsection
