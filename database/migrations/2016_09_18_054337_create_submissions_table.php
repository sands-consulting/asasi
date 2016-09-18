<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('vendor_id');
            $table->string('status')->index();
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

        Schema::create('submission_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->unsignedInteger('submission_id');
            $table->unsignedInteger('requirement_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('submissions');
    }
}
