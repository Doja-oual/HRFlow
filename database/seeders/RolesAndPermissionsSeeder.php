<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager=Role::create(['name'=>'manger']);
        $RH=Role::create(['name'=>'RH']);
        $employe=Role::create(['name'=>'employe']);

        $permissions=[
            'view employees',
            'edit employees',
            'delete employees',
            'manage payroll'
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo('view employees','delete employees');
        

    }
}
