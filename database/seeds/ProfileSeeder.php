<?php

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        Profile::insert([
            [
                'name'        => 'Admin',
                'description' => 'Administrador do sistema',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Editor',
                'description' => 'Editor de conteúdo',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Viewer',
                'description' => 'Somente visualização',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}

// Codigo para popular a tabela de perfis com dados iniciais. O método run() insere três perfis: Admin, Editor e Viewer, cada um com uma descrição e timestamps de criação e atualização.
