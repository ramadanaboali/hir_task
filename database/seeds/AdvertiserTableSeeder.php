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
        $result=factory(\App\Models\Advertiser::class, 50)->create();
    }
}
