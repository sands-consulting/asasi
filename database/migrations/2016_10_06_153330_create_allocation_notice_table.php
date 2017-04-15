<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('allocation_id');
            $table->unsignedInteger('notice_id');
            $table->decimal('amount', 20, 2);
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('allocation_id')
                ->references('id')
                ->on('allocations')
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
        Schema::drop('allocation_notice');
        Schema::enableForeignKeyConstraints();
    }
}
