<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type')->index();
            $table->unsignedInteger('upload_id')->index();
            $table->unsignedInteger('notice_id')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('upload_id')
                ->references('id')
                ->on('uploads')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
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
        Schema::drop('notice_files');
    }
}
