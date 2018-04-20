
@extends('layouts.inner')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="/files/js/jquery.matchHeight-min.js" type="text/javascript"></script>
<script>$(function() {
  $('.itemmatch').matchHeight({ property: 'min-height' });
});</script>

<div class="page bg-white animsition">
     @include('common.flash')

    <div class="page-main">
        <div class="page-content page-content-table" data-selectable="selectable">
            <div class="page-header">
                <div class="page-header-actions">
                    <form>
                        <div class="input-search input-search-dark">
                            <i class="input-search-icon wb-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ old('search', Request::get('search')) }}">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Media -->
            <div class="media-list is-grid padding-bottom-50">
                <h2>Assets</h2>
                <ul class="blocks blocks-100 blocks-xlg-6 blocks-lg-6 blocks-md-6 blocks-ms-6 blocks-xs-6" data-plugin="animateList" data-child=">li">
                    @if (count($assets) > 0)
                        @foreach ($assets as $asset)
                            <li>
                                <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">
                                    <div class="image-wrap">
                                        @if ($asset->cover_image)
                                            <a href="{{ url('asset', [$asset->id]) }}">
                                                <img class="image img-rounded" src="{{ asset($asset->cover_image) }}" alt="...">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="info-wrap">
                                        @if (count($asset->assetfiles))
                                            @foreach ($asset->assetfiles as $assetFile)
                                                <a href="{{ url('asset', [$asset->id]) }}" class="custom-label itemmatch">{{ $asset->name }}</a><br/>
                                                <div class="btn-group btn-group-justified">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ url('download/' . $assetFile->id) }}" type="button" class="btn btn-primary">
                                                            <i class="icon wb-download" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" href="{{ url('asset', [$asset->id]) }}" class="btn btn-success">
                                                            <i class="icon wb-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else

                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li>No files found</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
