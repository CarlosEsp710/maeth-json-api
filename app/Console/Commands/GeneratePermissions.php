<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate permissions for registered api resources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Lista de permisos

        //Roles
        Permission::firstOrCreate([
            'name' => 'roles:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'roles:index',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'roles:update',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'roles:read',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'roles:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'roles:delete',
            'guard_name' => 'sanctum'
        ]);
        //Usuarios
        Permission::firstOrCreate([
            'name' => 'users:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'users:index',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'users:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'users:read',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'users:update',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'users:delete',
            'guard_name' => 'sanctum'
        ]);
        // Nutriólogos
        Permission::firstOrCreate([
            'name' => 'nutritionists:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'nutritionists:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'nutritionists:update',
            'guard_name' => 'sanctum'
        ]);
        // Pacientes
        Permission::firstOrCreate([
            'name' => 'patients:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'patients:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'patients:update',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'patients:modify-nutritionist',
            'guard_name' => 'sanctum'
        ]);
        //Categorías
        Permission::firstOrCreate([
            'name' => 'categories:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'categories:index',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'categories:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'categories:read',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'categories:update',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'categories:delete',
            'guard_name' => 'sanctum'
        ]);
        //Artículos
        Permission::firstOrCreate([
            'name' => 'articles:admin',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:index',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:create',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:read',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:update',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:delete',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:modify-category',
            'guard_name' => 'sanctum'
        ]);
        Permission::firstOrCreate([
            'name' => 'articles:modify-author',
            'guard_name' => 'sanctum'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'sanctum'
        ]);

        $admin->givePermissionTo([
            'roles:admin',
            'users:admin',
            'nutritionists:admin',
            'patients:admin',
            'categories:admin',
            'articles:admin',
        ]);

        $nutritionist = Role::firstOrCreate([
            'name' => 'nutritionist',
            'guard_name' => 'sanctum'
        ]);

        $nutritionist->givePermissionTo([
            'users:index',
            'users:read',
            'users:update',
            'nutritionists:create',
            'nutritionists:update',
            'categories:index',
            'categories:read',
            'articles:index',
            'articles:create',
            'articles:read',
            'articles:update',
            'articles:delete',
            'articles:modify-category'
        ]);

        $patient = Role::firstOrCreate([
            'name' => 'patient',
            'guard_name' => 'sanctum'
        ]);

        $patient->givePermissionTo([
            'users:index',
            'users:read',
            'users:update',
            'patients:create',
            'patients:update',
            'categories:index',
            'categories:read',
            'articles:index',
            'articles:create',
            'articles:read',
            'articles:update',
            'articles:delete',
            'articles:modify-category'
        ]);

        $this->info('Permissions generated!');
    }
}
