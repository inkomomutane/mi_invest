<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::where('name', 'Beira')->first()->neighborhoods()->saveMany(
            [
                new Neighborhood([
                    'name' => 'Macuti',
                ]),
                new Neighborhood([
                    'name' => 'Palmeiras',
                ]),
                new Neighborhood([
                    'name' => 'Ponta-Gêa',
                ]),
                new Neighborhood([
                    'name' => 'Chaimite',
                ]),
                new Neighborhood([
                    'name' => 'Pioneiros',
                ]),
                new Neighborhood([
                    'name' => 'Esturro',
                ]),
                new Neighborhood([
                    'name' => 'Matacuane',
                ]),
                new Neighborhood([
                    'name' => 'Macurungo',
                ]),
                new Neighborhood([
                    'name' => 'Munhava-Central',
                ]),
                new Neighborhood([
                    'name' => 'Mananga',
                ]),
                new Neighborhood([
                    'name' => 'Vaz',
                ]),
                new Neighborhood([
                    'name' => 'Maraza',
                ]),
                new Neighborhood([
                    'name' => 'Chota',
                ]), new Neighborhood([
                    'name' => 'Alto da Manga',
                ]),
                new Neighborhood([
                    'name' => 'Nhaconjua',
                ]),
                new Neighborhood([
                    'name' => 'Chingussura',
                ]),
                new Neighborhood([
                    'name' => 'Vila Massane',
                ]),
                new Neighborhood([
                    'name' => 'Inhamízua',
                ]),
                new Neighborhood([
                    'name' => 'Matadouro',
                ]),
                new Neighborhood([
                    'name' => 'Mungassa',
                ]),
                new Neighborhood([
                    'name' => 'Ndunda',
                ]), new Neighborhood([
                    'name' => 'Manga Mascarenha',
                ]),
                new Neighborhood([
                    'name' => 'Muave',
                ]),

                new Neighborhood([
                    'name' => 'Nhangau',
                ]), new Neighborhood([
                    'name' => 'Nhangoma',
                ]),
                new Neighborhood([
                    'name' => 'Tchonja',
                ]),

            ]
        );
    }
}
