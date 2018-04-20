<?php

namespace App\Http\Controllers;

use Auth;
use App\Asset;
use App\AssetFile;
use App\Http\Requests;
use App\Libraries\Zip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * The Asset model
     */
    protected $assets;

    /**
     * The custom Zip helper class
     */
    protected $zip;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Asset $assets, Zip $zip)
    {
        $this->middleware('auth');

        $this->assets = $assets;
        $this->zip = $zip;
    }

    /**
     * Show the main Assets page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assets = $this->assets->filter($request->all())
            ->search($request->all())
            ->restrict(Auth::user()->id)
            ->where('region', Auth::user()->region)
            ->orderBy('name')
            ->allOrPaginate(! $request->has('download'));

        if (count($assets) && $request->has('download')) {
            return response()->download($this->zip->createFromAssets($assets, Auth::user()->id . '-' . date("Y-m-d-His") . '.zip'), 'Chicopee Assets.zip');
        }

        return view('assets.index', [
            'assets' => $assets,
        ]);
    }

    /**
     * Show the Asset page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Asset $asset)
    {
        $this->authorize('show', $asset);

        return view('assets.show', [
            'asset' => $asset,
        ]);
    }

    /**
     * Download the Asset File.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssetFile            $file
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request, AssetFile $file)
    {
        $this->authorize('download', $file);

        $pathToFile = storage_path('app/' . $file->filename);

        if (! is_file($pathToFile)) {
            return back()
                ->withError('Asset file not found');
        }

        return response()
            ->download($pathToFile);
    }

    /**
     * Show the settings page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        return view('users.settings', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store the settings page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function settingsUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'password' => 'min:6|confirmed',
        ]);

        Auth::user()->fill($request->only(['name', 'email']));

        if ($request->password) {
            Auth::user()->password = bcrypt($request->password);
        }

        Auth::user()->save();

        return redirect('assets')
            ->withSuccess('Settings saved');
    }
}
