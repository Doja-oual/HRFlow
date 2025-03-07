<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Supprimer la contrainte de clé étrangère
        $table->dropForeign(['role_id']);  // Remplacez `role_id` par le nom exact de la colonne de clé étrangère
        
        // Supprimer la colonne 'role_id'
        $table->dropColumn('role_id');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Vous pouvez recréer la colonne 'role_id' si vous devez revenir en arrière
        $table->unsignedBigInteger('role_id')->nullable();

        // Recréer la contrainte de clé étrangère
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
    });
}

};
