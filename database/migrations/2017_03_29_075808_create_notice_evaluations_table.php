<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('notice_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('evaluation_types')
                ->onDelete('cascade');

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
        Schema::drop('notice_evaluations');
    }
}
