<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('registration_number')->index();
            $table->string('tax_1_number');
            $table->string('tax_2_number');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('address_postcode');
            $table->string('address_city_id');
            $table->string('address_state_id');
            $table->string('address_country_id');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_telephone');
            $table->string('contact_fax');
            $table->string('contact_website');
            $table->string('capital_currency');
            $table->string('capital_authorized');
            $table->string('capital_paid_up');
            $table->unsignedInteger('type_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('vendor_types')
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
        Schema::drop('vendors');
    }
}
