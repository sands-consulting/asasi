<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('number');
            $table->text('description');
            $table->string('contact_name');
            $table->string('contact_position');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('contact_fax');
            $table->decimal('cost');
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('vendor_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onDelete('cascade');
        });

        Schema::create('allocation_project', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('allocation_id');
            $table->unsignedInteger('project_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('allocation_id')
                ->references('id')
                ->on('allocations')
                ->onDelete('cascade');
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('user_id');
            $table->string('position');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('allocation_project');
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('projects');
    }
}
