<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('allocation_id');
            $table->unsignedInteger('notice_id');
            $table->decimal('amount');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('allocation_id')
                ->references('id')
                ->on('notices')
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('notice_allocations');
        Schema::enableForeignKeyConstraints();
    }
}
