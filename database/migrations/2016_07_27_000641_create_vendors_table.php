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
            $table->string('name');
            $table->string('registration_number');
            
            $table->string('tax_1_number');
            $table->string('tax_2_number');
            
            $table->string('address_1');
            $table->string('address_2');
            $table->string('address_postcode');
            $table->unsignedInteger('address_city_id');
            $table->unsignedInteger('address_state_id');
            $table->unsignedInteger('address_country_id');

            $table->string('contact_telephone');
            $table->string('contact_fax');
            $table->string('contact_email');
            $table->string('contact_website');

            $table->string('contact_person_name');
            $table->string('contact_person_designation');
            $table->string('contact_person_telephone');
            $table->string('contact_person_email');

            $table->string('capital_currency');
            $table->string('capital_authorized');
            $table->string('capital_paid_up');
            
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('user_id');
            $table->string('status');
            
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('address_city_id')
                ->references('id')
                ->on('places');
            $table->foreign('address_state_id')
                ->references('id')
                ->on('places');
            $table->foreign('address_country_id')
                ->references('id')
                ->on('places');
            $table->foreign('type_id')
                ->references('id')
                ->on('vendor_types');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->index('name');
            $table->index('registration_number');
            $table->index('contact_telephone');
            $table->index('contact_fax');
            $table->index('contact_email');
            $table->index('contact_person_name');
            $table->index('contact_person_email');
            $table->index('contact_person_telephone');
            $table->index('status');
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
