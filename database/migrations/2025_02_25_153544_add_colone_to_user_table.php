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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
            $table->string('employee_id')->unique()->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('status')->default('Active');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('employee_id');
            $table->dropColumn('position');
            $table->dropColumn('department');
            $table->dropColumn('hire_date');
            $table->dropColumn('status');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('contract_type');
            $table->dropColumn('profile_picture');
        });
    }
};


