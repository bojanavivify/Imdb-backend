<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\WatchList;

class WatchListTableSeeder extends Seeder
{
    public function run()
    {
        factory(WatchList::class, 10)->create();
    }

}
