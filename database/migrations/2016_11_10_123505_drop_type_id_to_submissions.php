<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTypeIdToSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign('submissions_type_id_foreign');
            $table->dropColumn('type_id');
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
            $table->unsignedInteger('type_id')->after('notice_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('evaluation_types')
                ->onDelete('cascade');
        });
    }
}
