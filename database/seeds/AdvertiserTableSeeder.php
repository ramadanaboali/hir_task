<?php

use Illuminate\Database\Seeder;

class AdvertiserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Advertiser::factory()->count(50)->create();
    }
}
