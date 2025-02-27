<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 
        public function run(): void
        {
            DB::table('contract_types')->insert([
                [
                    'name' => 'CDI',
                    'description' => 'Contrat à Durée Indéterminée',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'CDD',
                    'description' => 'Contrat à Durée Déterminée',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Stage',
                    'description' => 'Convention de stage',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Freelance',
                    'description' => 'Mission en freelance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Alternance',
                    'description' => 'Contrat en alternance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Intérim',
                    'description' => 'Contrat de mission temporaire',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
