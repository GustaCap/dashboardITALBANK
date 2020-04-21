<?php

use Illuminate\Database\Seeder;

class TipoclientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoclientes')->insert([

            'tipo' => 'Individuos(IND)',
        ]);
        DB::table('tipoclientes')->insert([

            'tipo' => 'Cliente Empresa(CE)',
        ]);
        DB::table('tipoclientes')->insert([

            'tipo' => 'Cliente Bancos (CB)',
        ]);
        DB::table('tipoclientes')->insert([

            'tipo' => 'Cliente MSB (CM)',
        ]);

    }
}
