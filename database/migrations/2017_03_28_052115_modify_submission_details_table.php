<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySubmissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_details', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->dropColumn('requirement_id');
            $table->unsignedInteger('user_id')->nullable()->change();
            $table->timestamp('completed_at')->nullable()->after('user_id');
            $table->string('status')->after('completed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submission_details', function (Blueprint $table) {

            $table->dropColumn('completed_at');
            $table->dropColumn('status');
            $table->string('value')->after('id')->nullable();
            $table->unsignedInteger('user_id')->change();
            $table->unsignedInteger('requirement_id')->after('id')->nullable();

        });
    }
}
