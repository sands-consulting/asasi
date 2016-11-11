<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToSubmissionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_details', function (Blueprint $table) {
            $table->unsignedInteger('type_id')->after('value');
            $table->foreign('type_id')
                ->references('id')
                ->on('evaluation_types')
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
        Schema::table('submission_details', function (Blueprint $table) {
            $table->dropForeign('submission_details_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
