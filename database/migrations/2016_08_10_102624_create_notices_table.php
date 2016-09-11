<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('notice_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('notice_event_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('number');
            $table->text('description');
            $table->text('rules');
            $table->decimal('price');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('purchased_at')->nullable();
            $table->dateTime('submission_at')->nullable();
            $table->text('submission_address');
            $table->unsignedInteger('notice_type_id')->nullable();
            $table->unsignedInteger('notice_category_id')->nullable();
            $table->unsignedInteger('organization_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_type_id')
                ->references('id')
                ->on('notice_types')
                ->onDelete('cascade');

            $table->foreign('notice_category_id')
                ->references('id')
                ->on('notice_types')
                ->onDelete('cascade');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');
        });

        Schema::create('notice_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->datetime('event_at')->nullable();
            $table->string('location');
            $table->boolean('required');
            $table->unsignedInteger('notice_id')->nullable();
            $table->unsignedInteger('notice_event_type_id')->nullable();
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');

            $table->foreign('notice_event_type_id')
                ->references('id')
                ->on('notice_event_types')
                ->onDelete('set null');
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
        Schema::drop('notices');
        Schema::drop('notice_categories');
        Schema::drop('notice_types');
        Schema::drop('notice_events');
        Schema::drop('notice_event_types');
        Schema::enableForeignKeyConstraints();
    }
}
