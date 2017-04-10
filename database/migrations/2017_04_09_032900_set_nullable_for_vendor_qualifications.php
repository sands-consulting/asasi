<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableForVendorQualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_qualifications', function (Blueprint $table) {
            $table->string('reference_one')->nullable()->change();
            $table->string('reference_two')->nullable()->change();
            $table->date('start_at')->nullable()->change();
            $table->date('end_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_qualifications', function (Blueprint $table) {
            $table->string('reference_one')->change();
            $table->string('reference_two')->change();
            $table->date('start_at')->change();
            $table->date('end_at')->change();
        });
    }
}
