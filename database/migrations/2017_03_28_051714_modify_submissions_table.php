<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('submission_number')->nullable()->after('id');
            $table->string('label')->nullable()->after('submission_number');
            $table->unsignedInteger('notice_id')->after('price');

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['notice_id']);
            $table->dropColumn('submission_number');
            $table->dropColumn('label');
            $table->dropColumn('notice_id');
        });
    }
}
