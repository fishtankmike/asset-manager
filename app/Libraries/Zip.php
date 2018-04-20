<?php

namespace App\Libraries;

use ZipArchive;
use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemManager;

class Zip
{
    protected $storage;
    protected $zip;

    /**
     * Folder to store zip files, relative to "storage"
     *
     * @var string
     */
    private $folder = 'zips';

    /**
     * Setup the Zip class
     *
     * @param Storage    $storage
     * @param ZipArchive $zip
     */
    public function __construct(FilesystemManager $fsm, ZipArchive $zip)
    {
        $this->storage = $fsm;
        $this->zip = $zip;

        // Create folder to store zip files
        if (! $this->storage->has($this->folder)) {
            $this->storage->makeDirectory($this->folder);
        }

        $this->cleanupOldFiles();
    }

    /**
     * Create a zip file of all passed Assets & their AssetFiles
     *
     * @param  Illuminate\Database\Eloquent\Collection $assets
     * @param  mixed $assets
     * @return string
     */
    public function createFromAssets($assets, $filename)
    {
        $fullFilename = storage_path('app/' . $this->folder . '/' . $filename);

        $res = $this->zip->open($fullFilename, ZipArchive::CREATE);

        foreach ($assets as $asset) {
            $this->zip->addEmptyDir($asset->name);
            foreach ($asset->assetfiles as $file) {
                $this->zip->addFile(storage_path('app/' . $file->filename), $asset->name . '/' . basename($file->filename));
            }
        }

        $this->zip->close();

        return $fullFilename;
    }

    /**
     * Delete files older than yesterday
     *
     * @return void
     */
    public function cleanupOldFiles()
    {
        $files = $this->storage->listContents($this->folder);

        foreach ($files as $file) {
            if (Carbon::createFromTimestamp($file['timestamp'])->lt(Carbon::yesterday())) {
                $this->storage->delete($file['path']);
            }
        }
    }
}
