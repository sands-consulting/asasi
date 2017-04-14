<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationCodeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_code_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('qualification_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('name');
            $table->unsignedInteger('type_id');
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->foreign('type_id')
                ->references('id')
                ->on('qualification_code_types')
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
        Schema::drop('qualification_codes');
        Schema::drop('qualification_code_types');
    }
}
