<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUserIdFromSubmissionEvaluatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_evaluator', function (Blueprint $table) {
            $table->dropForeign('submission_evaluator_user_id_foreign');
            $table->renameColumn('user_id', 'evaluator_id');
            $table->foreign('evaluator_id')
                ->references('id')
                ->on('notice_evaluator')
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
        Schema::table('submission_evaluator', function (Blueprint $table) {
            $table->dropForeign('submission_evaluator_evaluator_id_foreign');
            $table->renameColumn('evaluator_id', 'user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
