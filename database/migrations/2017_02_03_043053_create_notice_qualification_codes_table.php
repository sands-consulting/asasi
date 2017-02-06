<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeQualificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->index();
            $table->integer('sequence')->index();
            $table->string('group_rule')->index();
            $table->string('join_rule')->index()->nullable();
            $table->unsignedInteger('code_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('notice_id')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('code_id')
                ->references('id')
                ->on('qualification_codes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('qualification_types')
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
        Schema::drop('notice_qualifications');
    }
}
