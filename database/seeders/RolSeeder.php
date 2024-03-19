<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $admin->syncPermissions(['administrador','','coordinador','agente']);

        $coordinador = Role::create([
            'name' => 'Coordinador',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $coordinador->syncPermissions(['coordinador']);

        $agente = Role::create([
            'name' => 'Agente de campo',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $agente->syncPermissions(['agente']);
    }
}
