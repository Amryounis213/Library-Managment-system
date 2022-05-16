<?php

namespace Database\Factories;

use App\Models\Children;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildrenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Children::class;


    public function definition()
    {
       return [
            'name'=> $this->faker->name ,
            'bth_date'=> date('Y-m-d'),
            'father_id'=> 1 ,
            'gender'=> 1 ,
            'status'=> 1,
            'added_by'=> 73 ,
            'add_date'=>date('Y-m-d') ,
            'identity'=> rand(1000000000 , 2000000000) ,
            'want_transport'=> 1 ,
            'address' => 'غزة' ,
            'father_rel'=>1 ,

        ];
    }
}
