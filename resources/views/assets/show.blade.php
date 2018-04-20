@extends('layouts.inner')

@section('content')

<div class="page bg-white animsition full-height">
    <div class="page-main full-height grey">
        @include('common.flash')

        <div class="page-header">
            <h1 class="page-title">View Asset: {{ $asset->name }}</h1>
        </div>
        <div class="page-content">
            <div class="panel">
                {{-- <div class="panel-heading">
                </div> --}}
                <div class="panel-body" style="padding-top:20px;">
                    <dl>
                        <dt>Category</dt><dd>{{ $asset->category_names }}</dd>
                        <dt>Name</dt><dd>{{ $asset->name }}</dd>
                    </dl>
                    <hr>
                    @if ($asset->cover_image)
                        <a href="{{ url('asset', [$asset->id]) }}">
                            <img class="image img-rounded" src="{{ asset($asset->cover_image) }}" alt="...">
                        </a>
                    @endif
                    <hr>
                    <h3 class="">Download</h3>
                    <table class="editable-table table table-striped" id="editableTable" style="cursor: pointer;">
                        <thead>
                        </thead>
                        <tbody>
                            @if (count($asset->assetfiles))
                                @foreach ($asset->assetfiles as $assetFile)
                                    <tr>
                                        <td tabindex="1"><a href="{{ url('download/' . $assetFile->id) }}">{{ basename($assetFile->filename) }}</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <td tabindex="1">Currently no files to display</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
