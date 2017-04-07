<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_files', function (Blueprint $table) {
            $table->renameColumn('file_id', 'type_id');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->string('line_one')->nullable()->change();
            $table->string('line_two')->nullable()->change();
            $table->string('postcode')->nullable()->change();
            $table->unsignedInteger('postcode')->nullable()->change();
            $table->unsignedInteger('postcode')->nullable()->change();
            $table->unsignedInteger('postcode')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('line_one')->nullable(false)->change();
            $table->string('line_two')->nullable(false)->change();
            $table->string('postcode')->nullable(false)->change();
            $table->unsignedInteger('postcode')->nullable(false)->change();
            $table->unsignedInteger('postcode')->nullable(false)->change();
            $table->unsignedInteger('postcode')->nullable(false)->change();
        });

        Schema::table('vendor_files', function (Blueprint $table) {
            $table->renameColumn('type_id', 'file_id');
        });
    }
}
