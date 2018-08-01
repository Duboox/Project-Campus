<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super User
        Role::create([
            'name' => 'developer',
            'slug' => 'developer',
            'description' => 'Super Usuario',
            'special' => 'all-access',
        ]);

        // Permission - Users create
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',      
        ]);

        /*Permission::create([
            'name'          => 'Activar usuario',
            'slug'          => 'users.confirmed',
            'description'   => 'Podría activar la cuenta de cualquier usuario del sistema',      
        ]);*/

        Permission::create([
            'name'          => 'Generar reporte de usuarios en PDF',
            'slug'          => 'users.pdf.view',
            'description'   => 'Se podria generar un reporte con la data de los usuarios',      
        ]);

        // Roles create
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',      
        ]);

        Permission::create([
            'name'          => 'Roles Asignados',
            'slug'          => 'roles.assigns',
            'description'   => 'Podría ver los roles asignados en el sistema',      
        ]);
    }
}
