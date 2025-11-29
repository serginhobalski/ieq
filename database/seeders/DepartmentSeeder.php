<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Crianças e Juniores',
                'slug' => 'gmc',
                'description' => 'Grupo Missionário de Crianças',
            ],
            [
                'name' => 'Jovens e Adolescentes',
                'slug' => 'gfq',
                'description' => 'Geração Forte Quadrangular',
            ],
            [
                'name' => 'Casais',
                'slug' => 'conac',
                'description' => 'Coordenadoria Nacional de Casais',
            ],
            [
                'name' => 'Homens',
                'slug' => 'gmh',
                'description' => 'Grupo Missionário de Homens',
            ],
            [
                'name' => 'Mulheres',
                'slug' => 'gmm',
                'description' => 'Grupo Missionário de Mulheres',
            ],
            [
                'name' => 'Música',
                'slug' => 'musica',
                'description' => '',
            ],
            [
                'name' => 'Comunicação',
                'slug' => 'secom',
                'description' => 'Secretaria de Comunicação',
            ],
            [
                'name' => 'Diaconato',
                'slug' => 'diaconato',
                'description' => 'Grupo de Diaconato da Igreja',
            ],
        ];

        foreach($departments as $d){
            Department::create($d);
        }

        echo 'Departamentos semeados com sucesso';
    }
}
