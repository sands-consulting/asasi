<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth');
            $table->string('name');
            $table->string('short_name');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')
                ->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->index('short_name');
            $table->index('lft');
            $table->index('rgt');
            $table->index('depth');
            $table->index('status');
        });

        Schema::create('organization_user', function (Blueprint $table) {
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('user_id');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
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
        Schema::drop('organization_user');
        Schema::drop('organizations');
    }
}
