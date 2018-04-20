<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Storage;
use App\Asset;
use App\AssetFile;
use App\User;
use App\Http\Requests;
use App\Libraries\Zip;
use Illuminate\Http\Request;

class AssetController extends Controller
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
     * Display a listing of the Assets.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assets = $this->assets
            ->with('category')
            ->filter($request->all())
            ->search($request->all())
            ->orderBy('name')
            ->allOrPaginate(! $request->has('download'));

        if (count($assets) && $request->has('download')) {
            return response()->download($this->zip->createFromAssets($assets, Auth::user()->id . '-' . date("Y-m-d-His") . '.zip'), 'Chicopee Assets.zip');
        }

        return view('assets.admin.index', [
            'assets' => $assets,
        ]);
    }

    /**
     * Show the form for creating a new Asset.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.admin.create', [
            'users' => $this->getUsersForAssetRestriction()
        ]);
    }

    /**
     * Store a newly created Asset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'region' => 'required',
            'categories' => 'required',
            'name' => 'required|max:255',
            'cover_image' => 'image',
            'asset_files.*' => 'file',
        ]);

        $asset = $this->assets->create([
            'region' => $request->region,
            'name' => $request->name,
        ]);

        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $imageName = $asset->id . '.' . $request->file('cover_image')->getClientOriginalExtension();
            $request->file('cover_image')->move(public_path('img/assets'), $imageName);

            Image::make(public_path('img/assets/' . $imageName))
                ->fit(200, 200, function ($constraint) {
                    // $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save();

            $asset->update(['cover_image' => 'img/assets/' . $imageName]);
        }

        if ($request->hasFile('asset_files')) {
            Storage::makeDirectory('assets/' . $asset->id);

            foreach ($request->file('asset_files') as $key => $file) {
                if (! $file->isValid()) {
                    continue;
                }

                $storageDestination = storage_path('app/assets/' . $asset->id);
                $fileName = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($storageDestination, $fileName);

                $asset->assetfiles()->save(new AssetFile(['filename' => 'assets/' . $asset->id . '/' . $fileName]));
            }
        }

        // Attach restricted Users
        if ($request->has('users')) {
            $asset->users()->sync($request->get('users'));
        }

        // Attach Categories
        if ($request->has('categories')) {
            $asset->categories()->sync($request->get('categories'));
        }

        return redirect('admin/assets')
            ->withSuccess('Asset added');
    }

    /**
     * Show the form for editing the Asset.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        return view('assets.admin.edit', [
            'asset' => $asset,
            'users' => $this->getUsersForAssetRestriction(),
            'restrictedUsers' => $asset->users()->lists('user_id')->toArray()
        ]);
    }

    /**
     * Update the Asset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset                $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        $this->validate($request, [
            'region' => 'required',
            'categories' => 'required',
            'name' => 'required|max:255',
            'cover_image' => 'image',
        ]);

        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $imageName = $asset->id . '.' . $request->file('cover_image')->getClientOriginalExtension();
            $request->file('cover_image')->move(public_path('img/assets'), $imageName);

            Image::make(public_path('img/assets/' . $imageName))
                ->fit(200, 200, function ($constraint) {
                    // $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save();

            $asset->update(['cover_image' => 'img/assets/' . $imageName]);
        }

        if ($request->hasFile('asset_files')) {
            Storage::makeDirectory('assets/' . $asset->id);

            foreach ($request->file('asset_files') as $key => $file) {
                if (! $file->isValid()) {
                    continue;
                }

                $storageDestination = storage_path('app/assets/' . $asset->id);
                $fileName = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($storageDestination, $fileName);

                $asset->assetfiles()->save(new AssetFile(['filename' => 'assets/' . $asset->id . '/' . $fileName]));
            }
        }

        $asset->fill($request->except(['cover_image', 'asset_files']));
        $asset->save();

        // Attach restricted Users
        $asset->users()->sync($request->get('users', []));
        // Attach Categories
        $asset->categories()->sync($request->get('categories', []));

        return redirect('admin/assets')
            ->withSuccess('Asset updated');
    }

    /**
     * Remove the Asset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset                $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Asset $asset)
    {
        $asset->delete();

        return redirect('admin/assets')
            ->withSuccess('Asset deleted');
    }

    /**
     * Get Users for Asset add/edit page for restricting access
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getUsersForAssetRestriction()
    {
        return User::where('type', 'user')->orderBy('name')->get();
    }
}
