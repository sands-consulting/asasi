<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_invitation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
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
        Schema::drop('notice_invitation');
    }
}
