<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('normalized_registration_number')->index()->after('registration_number');
        });

        Schema::create('vendor_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->string('role');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('vendor_qualification_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('code_id')
                ->references('id')
                ->on('qualification_codes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('qualification_code_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                ->references('id')
                ->on('vendor_qualification_codes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });  

        Schema::create('vendor_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id');
            $table->unsignedInteger('upload_id');
            $table->unsignedInteger('vendor_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('upload_id')
                ->references('id')
                ->on('uploads')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
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
        Schema::drop('vendor_files');
        Schema::drop('vendor_qualification_codes');
        Schema::drop('vendor_employees');

        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('normalized_registration_number');
        });
    }
}
