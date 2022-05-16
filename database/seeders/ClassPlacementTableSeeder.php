<?php

namespace Database\Seeders;

use App\Models\ClassPlacment;
use Illuminate\Database\Seeder;

class ClassPlacementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassPlacment::factory()->count(15)->create();
    }
}
