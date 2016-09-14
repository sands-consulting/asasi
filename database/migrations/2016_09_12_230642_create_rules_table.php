<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seq');
            $table->unsignedInteger('notice_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');
        });

        Schema::create('qualification_code_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qualification_code_id');
            $table->unsignedInteger('rule_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');

            $table->foreign('qualification_code_id')
                ->references('id')
                ->on('qualification_codes')
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
        Schema::drop('rules');
        Schema::drop('qualification_code_rule');
        Schema::enableForeignKeyConstraints();
    }
}
