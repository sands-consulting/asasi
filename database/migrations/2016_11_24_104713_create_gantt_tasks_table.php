<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanttTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gantt_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('duration');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('planned_start')->nullable();
            $table->timestamp('planned_end')->nullable();
            $table->decimal('progress');
            $table->timestamp('deadline')->nullable();
            $table->unsignedInteger('parent');
            $table->unsignedInteger('project_id');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gantt_tasks');
    }
}
