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
            'cylinder'=> 998,
            'torque'=> 112,
            'top_speed'=> 10,
            'weight'=> 300,
            'year'=> '2022-01-01',
            'image'=>'A1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2A',
            'name'=> 'R6',
            'cylinder'=> 600,
            'torque'=> 112,
            'top_speed'=> 295,
            'weight'=> 163,
            'year'=> '2012-01-02',
            'image'=>'A2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3A',
            'name'=> 'R3',
            'cylinder'=> 300,
            'torque'=> 26,
            'top_speed'=> 185,
            'weight'=> 166,
            'year'=> '2002-01-03',
            'image'=>'A3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4A',
            'name'=> 'R15',
            'cylinder'=> 151,
            'torque'=> 14,
            'top_speed'=> 155,
            'weight'=> 140,
            'year'=> '2004-01-04',
            'image'=>'A4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1B',
            'name'=> 'YZ',
            'cylinder'=> 85,
            'torque'=> 4,
            'top_speed'=> 145,
            'weight'=> 75,
            'year'=> '2022-01-05',
            'image'=>'B1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2B',
            'name'=> 'YZ',
            'cylinder'=> 121,
            'torque'=> 10,
            'top_speed'=> 148,
            'weight'=> 75,
            'year'=> '2022-01-06',
            'image'=>'B2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3B',
            'name'=> 'YZ',
            'cylinder'=> 160,
            'torque'=> 19,
            'top_speed'=> 167,
            'weight'=> 80,
            'year'=> '2022-01-07',
            'image'=>'B3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4B',
            'name'=> 'ktm duke',
            'cylinder'=> 199,
            'torque'=> 18,
            'top_speed'=> 145,
            'weight'=> 75,
            'year'=> '2022-01-08',
            'image'=>'B4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1C',
            'name'=> 'ktm duke',
            'cylinder'=> 390,
            'torque'=> 36,
            'top_speed'=> 203,
            'weight'=> 149,
            'year'=> '2022-01-09',
            'image'=>'C1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2C',
            'name'=> 'ktm duke',
            'cylinder'=> 690,
            'torque'=> 74,
            'top_speed'=> 190,
            'weight'=> 157,
            'year'=> '2022-01-10',
            'image'=>'C2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3C',
            'name'=> 'ktm duke',
            'cylinder'=> 1290,
            'torque'=> 141,
            'top_speed'=> 254,
            'weight'=> 75,
            'year'=> '2022-01-11',
            'image'=>'C3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4C',
            'name'=> 'ktm enduro r',
            'cylinder'=> 693,
            'torque'=> 73,
            'top_speed'=> 200,
            'weight'=> 111,
            'year'=> '2022-01-12',
            'image'=>'C3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1D',
            'name'=> 'dt',
            'cylinder'=> 125,
            'torque'=> 15,
            'top_speed'=> 120,
            'weight'=> 110,
            'year'=> '2022-01-13',
            'image'=>'D1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2D',
            'name'=> 'dt',
            'cylinder'=> 100,
            'torque'=> 13,
            'top_speed'=> 90,
            'weight'=> 94,
            'year'=> '2022-01-14',
            'image'=>'D2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3D',
            'name'=> 'dt',
            'cylinder'=> 175,
            'torque'=> 20,
            'top_speed'=> 132,
            'weight'=> 98,
            'year'=> '2022-01-15',
            'image'=>'D3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4D',
            'name'=> 'dt',
            'cylinder'=> 203,
            'torque'=> 22,
            'top_speed'=> 113,
            'weight'=> 90,
            'year'=> '2022-01-16',
            'image'=>'D4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1E',
            'name'=> 'rx',
            'cylinder'=> 110,
            'torque'=> 12,
            'top_speed'=> 125,
            'weight'=> 95,
            'year'=> '2022-01-17',
            'image'=>'E1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2E',
            'name'=> 'rx',
            'cylinder'=> 115,
            'torque'=> 9,
            'top_speed'=> 126,
            'weight'=> 91,
            'year'=> '2022-01-18',
            'image'=>'E2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3E',
            'name'=> 'rx',
            'cylinder'=> 124,
            'torque'=> 16,
            'top_speed'=> 137,
            'weight'=> 96,
            'year'=> '2022-01-19',
            'image'=>'E3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4E',
            'name'=> 'rx',
            'cylinder'=> 135,
            'torque'=> 17,
            'top_speed'=> 130,
            'weight'=> 108,
            'year'=> '2022-01-20',
            'image'=>'E4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1F',
            'name'=> 'kawasaki ninja h2r',
            'cylinder'=> 997,
            'torque'=> 310,
            'top_speed'=> 400,
            'weight'=> 216,
            'year'=> '2022-01-21',
            'image'=>'F1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2F',
            'name'=> 'kawasaki kmx',
            'cylinder'=> 126,
            'torque'=> 21,
            'top_speed'=> 130,
            'weight'=> 108,
            'year'=> '2022-01-22',
            'image'=>'F2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3F',
            'name'=> 'kawsaki klk',
            'cylinder'=> 152,
            'torque'=> 11,
            'top_speed'=> 115,
            'weight'=> 112,
            'year'=> '2022-01-23',
            'image'=>'F3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4F',
            'name'=> 'kawasaki victor m',
            'cylinder'=> 155,
            'torque'=> 34,
            'top_speed'=> 160,
            'weight'=> 124,
            'year'=> '2022-01-24',
            'image'=>'F4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1G',
            'name'=> 'kawasaki z',
            'cylinder'=> 400,
            'torque'=> 45,
            'top_speed'=> 170,
            'weight'=> 167,
            'year'=> '2022-01-25',
            'image'=>'G1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2G',
            'name'=> 'kawasaki z',
            'cylinder'=> 800,
            'torque'=> 113,
            'top_speed'=> 220,
            'weight'=> 229,
            'year'=> '2022-01-26',
            'image'=>'G2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3G',
            'name'=> 'kawasaki z',
            'cylinder'=> 1000,
            'torque'=> 111,
            'top_speed'=> 253,
            'weight'=> 220,
            'year'=> '2022-01-27',
            'image'=>'G3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4G',
            'name'=> 'kawasaki z10r',
            'cylinder'=> 996,
            'torque'=> 116,
            'top_speed'=> 304,
            'weight'=> 636,
            'year'=> '2022-01-28',
            'image'=>'G4.jpg'
        ]);
        CardsModel::insert([
            'id'=>'1H',
            'name'=> 'pulsar ns',
            'cylinder'=> 195,
            'torque'=> 23,
            'top_speed'=> 138,
            'weight'=> 182,
            'year'=> '2022-01-29',
            'image'=>'H1.jpg'
        ]);
        CardsModel::insert([
            'id'=>'2H',
            'name'=> 'dominar',
            'cylinder'=> 250,
            'torque'=> 24,
            'top_speed'=> 139,
            'weight'=> 180,
            'year'=> '2022-02-01',
            'image'=>'H2.jpg'
        ]);
        CardsModel::insert([
            'id'=>'3H',
            'name'=> 'dominar',
            'cylinder'=> 402,
            'torque'=> 40,
            'top_speed'=> 172,
            'weight'=> 184,
            'year'=> '2022-02-02',
            'image'=>'H3.jpg'
        ]);
        CardsModel::insert([
            'id'=>'4H',
            'name'=> 'pulsar rs',
            'cylinder'=> 205,
            'torque'=> 25,
            'top_speed'=> 140,
            'weight'=> 165,
            'year'=> '2022-02-03',
            'image'=>'H4.jpg'
        ]);
    }
}
