<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProfileSeeder::class,
        ]);
    }
}
// O DatabaseSeeder é o ponto de entrada para a execução dos seeders. Ele chama o ProfileSeeder para popular a tabela de perfis com os dados iniciais definidos no método run() do ProfileSeeder.
