@extends('layouts.admin')

@section('content')

<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
    <!-- Page Header -->
    <div class="page-header">  <h1 class="page-title">View Assets</h1>
      <ol class="breadcrumb">
        <li>Assets</li>

      </ol>

    </div>
    <!-- End Page Header -->
    <!-- Page Content -->
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">


   @include('common.errors')

    <form action="/admin/asset/{{ $asset->id }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Region</label>

            <div class="col-sm-6">
                {{ Form::select('region', App\User::$regions, old('region', $asset->region), ['placeholder' => '', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Categories</label>

            <div class="col-sm-6">
                {{ Form::select('categories[]', App\Category::getList(), old('categories', $asset->categories()->lists('categories.id')->all()), ['class' => 'form-control', 'multiple' => true, 'data-plugin' => 'select2']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $asset->name) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="cover_image" class="col-sm-3 control-label">Cover image</label>

            <div class="col-sm-6">
                @if ($asset->cover_image)
                    <img src="{{ asset($asset->cover_image . '?' . time()) }}" width="200" />
                @endif

                <input type="file" name="cover_image" id="cover_image">
            </div>
        </div>

        <div class="form-group asset-file">
            <label class="col-sm-3 control-label">Asset File</label>

            <div class="col-sm-4">
                <input type="file" name="asset_files[]">
            </div>

          <!--  <div class="col-sm-2 text-right">
                <button type="button" class="btn btn-sm btn-default btn-success">
                    <span class="fa fa-plus"></span>
                </button>
                <button type="button" class="btn btn-sm btn-default btn-danger hidden">
                    <span class="fa fa-minus"></span>
                </button>
            </div> -->
        </div>

        <div class="form-group asset-file">
            <label class="col-sm-3 control-label">Restrict Access</label>

            <div class="col-sm-6">
                <table class="table table-striped table-bordered">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td class="text-center">
                            {{ Form::checkbox('users[' . $user->id . ']', $user->id, old('users[' . $user->id . ']', in_array($user->id, $restrictedUsers))) }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a href="{{ url('admin/assets') }}" class="btn btn-default">
                    Cancel
                </a>
                <button type="submit" class="btn btn-default btn-primary pull-right">
                    <i class="fa fa-btn fa-pencil"></i> Edit Asset
                </button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Existing Asset Files</div>

                <table class="table">
                    <tbody>
                        @if (count($asset->assetfiles))
                            @foreach ($asset->assetfiles as $file)
                            <tr>
                                <td><a href="{{ url('admin/asset-file/' . $file->id) }}">{{ basename($file->filename) }}</a></td>
                                <td class="text-right">
                                    <form action="{{ url('admin/asset-file/' . $file->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Currently no files uploaded</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        </div>
      </div>
    </div>
    <!-- End Page Content -->
  </div>








@endsection









<!--<script type="text/javascript">
$(function() {
    $(document).on('click', '.btn-success', function (e) {
        e.preventDefault();

        var $clone = $(this).parents('.asset-file').clone(true);

        // $clone.find(':input').val('');
        $clone.find('.btn-success').addClass('hidden');
        $clone.find('.btn-danger').removeClass('hidden');

        $clone.insertAfter($('.asset-file:last'));
    });

    $(document).on('click', '.asset-file .btn-danger', function (e) {
        e.preventDefault();

        $(this).parents('.asset-file').remove();
    });
});
</script>-->
