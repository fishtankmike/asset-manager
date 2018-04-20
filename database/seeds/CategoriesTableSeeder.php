<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1 = DB::table('categories')->insertGetId([
            'name' => 'Product Sell Sheet',
            'created_at' => date('Y-m-d H:i:s')
        ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'Healthcare',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'General Purpose',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'Building Care',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'Foodservice',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'Customizable',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat1,
                'name' => 'Literature Bundles',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        $cat2 = DB::table('categories')->insertGetId([
            'name' => 'Product Folder',
            'created_at' => date('Y-m-d H:i:s')
        ]);
            DB::table('categories')->insert([
                'parent_id' => $cat2,
                'name' => 'Healthcare',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat2,
                'name' => 'General Purpose',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat2,
                'name' => 'Building Care',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat2,
                'name' => 'Foodservice',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat2,
                'name' => 'Chicopee',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        $cat3 = DB::table('categories')->insertGetId([
            'name' => 'Product Images',
            'created_at' => date('Y-m-d H:i:s')
        ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'Building Care',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'Customizable',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'Foodservice',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'General Purpose',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'Healthcare',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat3,
                'name' => 'Literature Bundles',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        $cat4 = DB::table('categories')->insertGetId([
            'name' => 'Video',
            'created_at' => date('Y-m-d H:i:s')
        ]);
            DB::table('categories')->insert([
                'parent_id' => $cat4,
                'name' => 'Order DVD',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat4,
                'name' => 'Download High Resolution',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            DB::table('categories')->insert([
                'parent_id' => $cat4,
                'name' => 'Download Low Resolution',
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }
}
