<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsasiMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing revisions
        Schema::create('revisions', function ($table) {
            $table->increments('id');
            $table->string('revisionable_type');
            $table->unsignedInteger('revisionable_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('key');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->nullableTimestamps();

            $table->index(['revisionable_id', 'revisionable_type']);
        });

        // Create table for storing user logs
        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->text('remarks');
            $table->string('actionable_type')->nullable();
            $table->integer('actionable_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->unsignedInteger('user_id');
            $table->nullableTimestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->index('action');
            $table->index('ip_address');
            $table->index(['actionable_type', 'actionable_id']);
        });

        // Create table for storing user blacklists        
        Schema::create('user_blacklists', function (Blueprint $table) {
            $table->increments('id');
            $table->text('reason');
            $table->unsignedInteger('user_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->datetime('expired_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->index('status');
            $table->index('expired_at');
        });

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->string('description')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group');
            $table->string('name');
            $table->string('description');
            $table->nullableTimestamps();
            $table->softDeletes();
            
            $table->unique(['group', 'name']);
        });


        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_blacklists');
        Schema::dropIfExists('user_logs');
        Schema::dropIfExists('revisions');
    }
}
