<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           Role::create(['name' => 'RH']);
           Role::create(['name' => 'manager']);
           Role::create(['name' => 'employee']);
   
           Permission::create(['name' => 'view employees']);
           Permission::create(['name' => 'edit employees']);
           Permission::create(['name' => 'delete employees']);
           Permission::create(['name' => 'manage payroll']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::whereIn('name', ['admin', 'manager', 'employe'])->delete();
        Permission::whereIn('name', ['view employees', 'edit employees', 'delete employees', 'manage payroll'])->delete();
    }
};
