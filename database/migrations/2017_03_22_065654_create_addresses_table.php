<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('line_one');
            $table->string('line_two');
            $table->string('postcode');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('country_id');
            $table->string('item_type')->index();
            $table->unsignedInteger('item_id')->index();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('city_id')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');

            $table->foreign('state_id')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('places')
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
        Schema::drop('addresses');
    }
}
