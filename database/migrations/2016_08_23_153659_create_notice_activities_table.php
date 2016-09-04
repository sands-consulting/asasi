<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activitable_type');
            $table->unsignedInteger('activitable_id');
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

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
        Schema::disableForeignKeyConstraints();
        Schema::drop('notice_activities');
        Schema::enableForeignKeyConstraints();
    }
}
