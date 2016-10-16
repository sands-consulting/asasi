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
            $table->string('status');
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
            $table->string('status');
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

        Schema::create('evaluation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('evaluation_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sequence')->nullable;
            $table->string('title');
            $table->unsignedInteger('full_score')->default(0);
            $table->unsignedInteger('evaluation_type_id');
            $table->unsignedInteger('notice_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('evaluation_type_id')
                ->references('id')
                ->on('evaluation_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedInteger('evaluation_requirement_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('evaluation_requirement_id')
                ->references('id')
                ->on('evaluation_requirements')
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
        Schema::dropIfExists('submission_evaluator');
        Schema::dropIfExists('evaluation_scores');
        Schema::dropIfExists('evaluation_types');
        Schema::dropIfExists('evaluation_requirements');
        Schema::enableForeignKeyConstraints();
    }
}
