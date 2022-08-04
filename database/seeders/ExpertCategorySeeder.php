<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpertCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('expertscategory')->insert([
            'category' => 'Literature'
        ]);
        DB::table('expertscategory')->insert([
            'category' => 'Reading'
        ]);
        DB::table('expertscategory')->insert([
            'category' => 'Astronomy'
        ]);
        DB::table('expertscategory')->insert([
            'category' => 'Physics'
        ]);
    }
}
