<?php

namespace App\Console\Commands;

use App\Asset;
use Illuminate\Console\Command;

class MigrateAssetCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate "belongsTo" Categories to "belongsToMany"';

    protected $assets;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Asset $assets)
    {
        parent::__construct();

        $this->assets = $assets;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->assets->all() as $asset) {
            if (! count($asset->categories)) {
                $asset->categories()->attach($asset->category_id);
                $this->info('Asset migrated to Category: ' . $asset->category->name);
            }
        }
    }
}
