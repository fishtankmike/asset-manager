<?php

namespace App\Providers;

use App\Asset;
use App\AssetFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Asset has been deleted
        Asset::deleted(function ($asset) {
            // Remove Asset cover image
            if (Storage::disk('images')->has(str_replace('img/', '', $asset->cover_image))) {
                Storage::disk('images')->delete(str_replace('img/', '', $asset->cover_image));
            }

            // Remove all attached Asset files
            foreach ($asset->assetfiles as $assetFile) {
                $assetFile->delete();
            }
        });

        // Asset File has been deleted
        AssetFile::deleted(function ($assetFile) {
            // Remove Asset file
            if (Storage::disk('local')->has($assetFile->filename)) {
                Storage::disk('local')->delete($assetFile->filename);
            }

            if (empty(Storage::disk('local')->files('assets/' . $assetFile->asset_id))) {
                Storage::disk('local')->deleteDirectory('assets/' . $assetFile->asset_id);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
