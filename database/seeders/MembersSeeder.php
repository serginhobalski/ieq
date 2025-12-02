<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Dayse Santos',
                'phone' => '21 97010-2113',
            ],
            [
                'name' => 'Beth Barreto',
                'phone' => '21 99921-2321',
            ],
            [
                'name' => 'Angela Maria',
                'phone' => '21 98736-2419',
            ],
            [
                'name' => 'Celia Paes',
                'phone' => '21 99113-0106',
            ],
            [
                'name' => 'Dinea Paula',
                'phone' => '21 96705-7730',
            ],
            [
                'name' => 'Ivone Brazil',
                'phone' => '21 99808-8060',
            ],
            [
                'name' => 'Julia Anchieta',
                'phone' => '21 99540-1850',
            ],
            [
                'name' => 'Dilson Fonseca',
                'phone' => '21 98590-9663',
            ],
            [
                'name' => 'Monica Bento',
                'phone' => '21 98468-6739',
            ],
            [
                'name' => 'Daiane Costa',
                'phone' => '68 9202-0370',
            ],
            [
                'name' => 'Jarbas Silvério',
                'phone' => '21 97990-3836',
            ],
            [
                'name' => 'Jonathan Costa',
                'phone' => '21 96447-0656',
            ],
            [
                'name' => 'Leticia Obalski',
                'phone' => '21 98080-1422',
            ],
            [
                'name' => 'Marcia Costa',
                'phone' => '21 98635-6076',
            ],
            [
                'name' => 'Margarida Cunha',
                'phone' => '21 98734-2275',
            ],
            [
                'name' => 'Maria das Graças',
                'phone' => '21 99370-5199',
            ],
            [
                'name' => 'Marli Costa',
                'phone' => '21 97645-2358',
            ],
            [
                'name' => 'Nivalda Monteiro',
                'phone' => '21 99855-1878',
            ],
            [
                'name' => 'Nubia Angelita',
                'phone' => '21 99244-3744',
            ],
            [
                'name' => 'Romilda',
                'phone' => '21 98606-1680',
            ],
            [
                'name' => 'Rosangela Paula',
                'phone' => '21 97027-1502',
            ],
            [
                'name' => 'Sergio Andrade',
                'phone' => '21 99288-2525',
            ],
            [
                'name' => 'Teresinha Lucinda',
                'phone' => '21 96513-2300',
            ],
            [
                'name' => 'Vanessa Bento',
                'phone' => '21 98885-9846',
            ],
            [
                'name' => 'Sergio Obalski Neto',
                'phone' => '21 97371-2106',
            ],
            [
                'name' => 'Ana Luiza',
                'phone' => '21 99605-5339',
            ],
            [
                'name' => 'Livia Victoria',
                'phone' => '21 97878-3786',
            ],
            [
                'name' => 'Luiz Henrique',
                'phone' => '21 96777-0241',
            ],
            [
                'name' => 'Sara Obalski',
                'phone' => '21 98100-4363',
            ],
            [
                'name' => 'Lara',
                'phone' => '21 99468-8053',
            ],
            [
                'name' => 'Elenice Nakasato',
                'phone' => '21 98304-6307',
            ],
            [
                'name' => 'Jose Ribamar',
                'phone' => '21 98473-1290',
            ],
            [
                'name' => 'Leandro',
                'phone' => '21 98324-4974',
            ],
            [
                'name' => 'Nalva',
                'phone' => '21 99519-5842',
            ],
            [
                'name' => 'Rachel Paula',
                'phone' => '21 96486-0700',
            ],
        ];

        foreach($members as $m){

            ## 1. Gerar o Username
            // 1.1. Converte para minúsculas
            $username_lower = strtolower($m['name']);

            // 1.2. Remove espaços em branco (substitui ' ' por '')
            $generated_username = str_replace(' ', '', $username_lower);

            // Opcional: Remove caracteres acentuados se necessário (necessita de função extra)
            // Para esta solução, vamos assumir que apenas minúsculas e sem espaço é suficiente.

            // 1.3. Atribui ao array
            $m['username'] = $generated_username;

            ## 2. Gerar o Email
            // 2.1. Usa o username gerado + '@mail.com'
            $generated_email = $m['username'] . '@gmail.com';

            // 2.2. Atribui ao array
            $m['email'] = $generated_email;

            User::create([
                'name' => $m['name'],
                'username' => $generated_username,
                'email' => $generated_email,
                'phone' => $m['phone'],
                'password' => Hash::make('123456789'),
                'is_admin' => false,
            ]);
        }

        echo "Membros cadastrados com sucesso!";
    }
}
