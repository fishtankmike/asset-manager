<?php

namespace App\Http\Controllers;

use App\AssetFile;
use App\Http\Requests;
use Illuminate\Http\Request;

class AssetFileController extends Controller
{
    /**
     * The Asset File model
     */
    protected $assetFiles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AssetFile $assetFiles)
    {
        $this->middleware('auth');

        $this->assetFiles = $assetFiles;
    }

    /**
     * Show the Asset File.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssetFile            $file
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AssetFile $file)
    {
        $pathToFile = storage_path('app/' . $file->filename);

        if (! is_file($pathToFile)) {
            return back()
                ->withError('Asset file not found');
        }

        return response()
            ->download($pathToFile);
    }

    /**
     * Remove the Asset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset                $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AssetFile $file)
    {
        $file->delete();

        return back()
            ->withSuccess('Asset File deleted');
    }
}
