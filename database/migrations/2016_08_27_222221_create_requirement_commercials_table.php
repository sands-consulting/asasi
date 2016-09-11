<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_commercials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('mandatory')->default(0);
            $table->boolean('require_file')->default(0);
            $table->unsignedInteger('notice_id');
            $table->string('status');
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
        Schema::drop('requirement_commercials');
        Schema::enableForeignKeyConstraints();
    }
}
