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
        // Ajouter la colonne role_id
        $table->unsignedBigInteger('role_id')->nullable();

        // Ajouter la clé étrangère
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');

        // Supprimer l'ancienne colonne 'role' si nécessaire
        $table->dropColumn('role');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Revenir en arrière en cas de rollback
        $table->dropForeign(['role_id']);
        $table->dropColumn('role_id');
        $table->string('role')->nullable();
    });
}

};
