<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value')->nullable();
            $table->unsignedInteger('detail_id');
            $table->unsignedInteger('requirement_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('detail_id')
                ->references('id')
                ->on('submission_details')
                ->onDelete('cascade');

            $table->foreign('requirement_id')
                ->references('id')
                ->on('submission_requirements')
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
        Schema::dropIfExists('submission_items');
    }
}
