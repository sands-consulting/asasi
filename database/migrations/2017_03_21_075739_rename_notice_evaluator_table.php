<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNoticeEvaluatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('notice_evaluator', 'evaluations');

        Schema::table('evaluations', function (Blueprint $table) {
            $table->decimal('score', 5, 2)->after('id')->index();
            $table->text('remarks')->after('score');
            $table->unsignedInteger('submission_id')->after('notice_id');

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('evaluation_scores', function (Blueprint $table) {
            $table->unsignedInteger('evaluation_id')->after('remark');
            $table->renameColumn('remark', 'remarks');
            $table->renameColumn('evaluation_requirement_id', 'requirement_id');
            $table->dropForeign(['submission_id']);
            $table->dropColumn('submission_id');

            $table->foreign('evaluation_id')
                ->references('id')
                ->on('evaluations')
                ->onUpdate('cascade')
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
        Schema::table('evaluation_scores', function (Blueprint $table) {
            $table->unsignedInteger('submission_id')->after('requirement_id');
            $table->renameColumn('remarks', 'remark');
            $table->renameColumn('requirement_id', 'evaluation_requirement_id');

            $table->dropForeign(['evaluation_id']);
            $table->dropColumn('evaluation_id');

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['submission_id']);
            $table->dropColumn(['remarks', 'score', 'submission_id']);
        });

        Schema::rename('evaluations', 'notice_evaluator');
    }
}
