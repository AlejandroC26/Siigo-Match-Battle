<?php

namespace Database\Seeders;

use App\Models\CardsModel;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CardsModel::insert([
            'id'=>'1A',
            'name'=> 'R1',
            'cylinder'=> 1290,
            'torque'=> 10,
            'top_speed'=> 10,
            'weight'=> 10,
            'year'=> '2022-01-01',
            'image'=>'default.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2A',
            'name'=> 'R2',
            'cylinder'=> 1390,
            'torque'=> 15,
            'top_speed'=> 11,
            'weight'=> 12,
            'year'=> '2012-01-01',
            'image'=>'default.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3A',
            'name'=> 'R3',
            'cylinder'=> 190,
            'torque'=> 5,
            'top_speed'=> 2,
            'weight'=> 1,
            'year'=> '2002-01-01',
            'image'=>'default.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4A',
            'name'=> 'R4',
            'cylinder'=> 192,
            'torque'=> 7,
            'top_speed'=> 12,
            'weight'=> 12,
            'year'=> '2004-01-01',
            'image'=>'default.jpg'
        ]);
        CardsModel::insert([
            'id'=>'5A',
            'name'=> 'R5',
            'cylinder'=> 122,
            'torque'=> 3,
            'top_speed'=> 9,
            'weight'=> 3,
            'year'=> '2044-01-01',
            'image'=>'default.jpg'
        ]);
    }
}
