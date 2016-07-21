<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('category_id');
            $table->string('slug')->index();
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('id')
                ->on('news_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('news_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action')->index();
            $table->string('ip_address')->index();
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('link');
            $table->unsignedInteger('news_id');
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
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
        Schema::drop('banners');
        Schema::drop('news_logs');
        Schema::drop('news');
        Schema::drop('news_categories');
    }
}
