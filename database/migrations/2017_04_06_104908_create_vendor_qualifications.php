<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorQualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_one')->index();
            $table->string('reference_two')->index();
            $table->date('start_at');
            $table->date('end_at');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('qualification_types')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
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
        Schema::drop('vendor_qualifications');
    }
}
