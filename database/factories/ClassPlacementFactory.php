<?php

namespace Database\Factories;

use App\Models\ClassPlacment;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassPlacementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = ClassPlacment::class;
    public function definition()
    {
        $emp =Employee::inRandomOrder()->first();
        $level =Level::inRandomOrder()->first();
        $division =Division::inRandomOrder()->first();
        return [
            'period_id' => rand(1 , 2),
            'employee_id' => $emp->id , 
            'level_id'=>$level->id,
            'division_id'=>$division->id,
            'children_id'=>rand(10 , 20),
            'year' => '2021-2022',
            'kindergarten_id'=> rand(1,3),
        ];
    }
}
