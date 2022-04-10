<?php

use Illuminate\Database\Seeder;

class ShowtimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Showtime::class, 1000)->create();
    }
}
