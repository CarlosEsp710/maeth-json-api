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
        Permission::firstOrCreate(['name' => 'roles:admin']);
        Permission::firstOrCreate(['name' => 'roles:index']);
        Permission::firstOrCreate(['name' => 'roles:update']);
        Permission::firstOrCreate(['name' => 'roles:read']);
        Permission::firstOrCreate(['name' => 'roles:create']);
        Permission::firstOrCreate(['name' => 'roles:delete']);
        //Usuarios
        Permission::firstOrCreate(['name' => 'users:admin']);
        Permission::firstOrCreate(['name' => 'users:index']);
        Permission::firstOrCreate(['name' => 'users:create']);
        Permission::firstOrCreate(['name' => 'users:read']);
        Permission::firstOrCreate(['name' => 'users:update']);
        Permission::firstOrCreate(['name' => 'users:delete']);
        //Categorías
        Permission::firstOrCreate(['name' => 'categories:admin']);
        Permission::firstOrCreate(['name' => 'categories:index']);
        Permission::firstOrCreate(['name' => 'categories:create']);
        Permission::firstOrCreate(['name' => 'categories:read']);
        Permission::firstOrCreate(['name' => 'categories:update']);
        Permission::firstOrCreate(['name' => 'categories:delete']);
        //Artículos
        Permission::firstOrCreate(['name' => 'articles:admin']);
        Permission::firstOrCreate(['name' => 'articles:index']);
        Permission::firstOrCreate(['name' => 'articles:create']);
        Permission::firstOrCreate(['name' => 'articles:read']);
        Permission::firstOrCreate(['name' => 'articles:update']);
        Permission::firstOrCreate(['name' => 'articles:delete']);
        Permission::firstOrCreate(['name' => 'articles:modify-category']);
        Permission::firstOrCreate(['name' => 'articles:modify-author']);

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $admin->givePermissionTo([
            'roles:admin',
            'users:admin',
            'categories:admin',
            'articles:admin',
        ]);

        $this->info('Permissions generated!');
    }
}
