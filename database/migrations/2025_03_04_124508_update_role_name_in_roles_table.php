<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class UpdateRoleNameInRolesTable extends Migration
{
    public function up()
    {
        DB::table('roles')
            ->where('name', 'employe')
            ->update(['name' => 'employee']);
    }

    public function down()
    {
        DB::table('roles')
            ->where('name', 'employee')
            ->update(['name' => 'employe']);
    }
}
