<?php

namespace Database\Seeders;

use App\Models\Department;
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
                'name' => 'Infantil',
                'slug' => 'gmc',
                'description' => 'Grupo Missionário de Crianças e Juniores',
            ],
            [
                'name' => 'Jovens',
                'slug' => 'gfq',
                'description' => 'Geração Forte Quadrangular - Grupo de Joverns e Adolescentes',
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
                'description' => 'Grupo de Louvor e Música',
            ],
            [
                'name' => 'Comunicação',
                'slug' => 'secom',
                'description' => 'Secretaria de Comunicação, Marketing e Mídias Sociais',
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
