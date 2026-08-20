<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // Essa linha é obrigatória!

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // É esse comando aqui que o seu arquivo não está executando
        Customer::factory(10)->create();
    }
}