<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableForAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->nullable()->change();
            $table->unsignedInteger('state_id')->nullable()->change();
            $table->unsignedInteger('country_id')->nullable()->change();
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
            $table->unsignedInteger('city_id')->nullable(false)->change();
            $table->unsignedInteger('state_id')->nullable(false)->change();
            $table->unsignedInteger('country_id')->nullable(false)->change();
        });
    }
}
