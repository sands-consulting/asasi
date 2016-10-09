<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->string('title');
            $table->integer('sequence');
            $table->unsignedInteger('evaluation_type_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('evaluation_type_id')
                ->references('id')
                ->on('evaluation_types')
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
        Schema::dropIfExists('evaluation_requirements');
        Schema::dropIfExists('evaluation_types');
    }
}
