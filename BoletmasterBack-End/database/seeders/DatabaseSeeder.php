<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'nombre'   => 'Admin',
            'apellido' => 'Admin',
            'usuario'  => 'admin',
            'email'    => 'admin@example.com',
            'rol'      => true,
        ]);

        User::factory()->create([
            'nombre'   => 'Normal',
            'apellido' => 'Normal',
            'usuario'  => 'Normal',
            'email'    => 'normal@example.com',
            'rol'      => false,
        ]);
        $this->call(CategorySeeder::class);
        $this->call(EventSeeder::class);
    }
}
