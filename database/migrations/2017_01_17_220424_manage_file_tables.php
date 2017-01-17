<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManageFileTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('file_rules');
        Schema::rename('files', 'file_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('file_types', 'files');
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
}
