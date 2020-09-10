<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert([
            'name' => 'POLICLÍNICA TOMBA - OSVALDO MONTEIRO PIRAJÁ',
            'email' => 'poli_tomba@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA PARQUE IPÊ - EMÍLIA FREITAS CRUZ',
            'email' => 'poli_pqipe@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA RUA NOVA - FRANCISCO MARTINS DA SILVA',
            'email' => 'poli_rn@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA FEIRA X - JOÃO DURVAL CARNEIRO',
            'email' => 'poli_fx@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA GEORGE AMÉRICO',
            'email' => 'poli_ga@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA HUMILDES - YARA E ESTEFFANY BISPO',
            'email' => 'poli_humildes@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'POLICLÍNICA DE SÃO JOSÉ',
            'email' => 'poli_sj@poli.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'UPA TIPO 1 MANGABEIRA',
            'email' => 'upa1@upa.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'UPA TIPO 2 QUEIMADINHA',
            'email' => 'upa2@upa.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'UPA TIPO 3 - CLÉRISTON ANDRADE',
            'email' => 'upa3@upa.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'id' => 999,
            'name' => 'CENTRAL SAMU',
            'email' => 'samu@samu.com',
            'password' => Hash::make('123'),
        ]);
    }
}
