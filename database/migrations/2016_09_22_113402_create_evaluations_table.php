<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_evaluators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('submission_evaluator', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('submission_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('submission_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedInteger('submission_detail_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('submission_detail_id')
                ->references('id')
                ->on('submission_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('notice_evaluators');
        Schema::dropIfExists('submission_evaluators');
        Schema::dropIfExists('submission_evaluations');
        Schema::enableForeignKeyConstraints();
    }
}
