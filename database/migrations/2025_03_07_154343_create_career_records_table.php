<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('career_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type');  
            $table->text('notes')->nullable();  
            $table->date('start_date');  
            $table->date('end_date')->nullable();  
            $table->string('status');  
            $table->decimal('salary', 10, 2)->nullable();  
            $table->foreignId('formation_id')->nullable()->constrained('formations');
            $table->foreignId('contract_type_id')->nullable()->constrained('contract_types');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_records');
    }
}
