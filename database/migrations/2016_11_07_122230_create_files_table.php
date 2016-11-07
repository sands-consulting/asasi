<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->index();
            $table->string('description');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('file_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scope')->index();
            $table->text('rule');
            $table->unsignedInteger('file_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
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
        Schema::drop('file_rules');
        Schema::drop('files');
    }
}
