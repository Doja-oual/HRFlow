<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_type_id')->after('user_id');
            $table->foreign('contract_type_id')->references('id')->on('contract_types')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['contract_type_id']);
            $table->dropColumn('contract_type_id');
        });
    }
};
