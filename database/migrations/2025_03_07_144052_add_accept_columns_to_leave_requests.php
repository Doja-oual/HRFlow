
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptColumnsToLeaveRequests extends Migration
{
    public function up()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->boolean('accept_rh')->default(false);  // Indiquer si accepté par RH
            $table->boolean('accept_manager')->default(false);  // Indiquer si accepté par le Manager
        });
    }

    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropColumn('accept_rh');
            $table->dropColumn('accept_manager');
        });
    }
}
