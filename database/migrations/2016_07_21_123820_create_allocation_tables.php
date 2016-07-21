<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('value', 15, 2);
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('organization_id');
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->foreign('type_id')
                ->references('id')
                ->on('allocation_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
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
        Schema::drop('allocations');
        Schema::drop('allocation_types');
    }
}
