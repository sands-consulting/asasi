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
            $table->string('number')->nullable()->index();
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('user_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->timestamp('accepted_at')->nullable();

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

        Schema::create('evaluation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('score', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('submission_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('user_id');
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('evaluation_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('evaluation_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sequence')->nullable;
            $table->boolean('mandatory')->default(0);
            $table->text('title');
            $table->unsignedInteger('full_score')->default(0);
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('evaluation_id');
            $table->unsignedInteger('notice_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('evaluation_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('evaluation_id')
                ->references('id')
                ->on('evaluations')
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
            $table->text('remarks')->nullable();
            $table->unsignedInteger('requirement_id');
            $table->unsignedInteger('submission_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('requirement_id')
                ->references('id')
                ->on('evaluation_requirements')
                ->onDelete('cascade');

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('evaluation_scores');
        Schema::drop('evaluation_requirements');
        Schema::drop('evaluations');
        Schema::drop('evaluation_types');
        Schema::drop('notice_evaluators');
    }
}
