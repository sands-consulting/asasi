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
            
            $table->string('tax_1_number')->nullable();
            $table->string('tax_2_number')->nullable();
            
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_postcode')->nullable();
            $table->unsignedInteger('address_city_id')->nullable()->default(null);
            $table->unsignedInteger('address_state_id')->nullable()->default(null);
            $table->unsignedInteger('address_country_id')->nullable()->default(null);

            $table->string('contact_telephone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_website')->nullable();

            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_telephone')->nullable();
            $table->string('contact_person_email')->nullable();

            $table->string('capital_currency')->nullable();
            $table->string('capital_authorized')->nullable();
            $table->string('capital_paid_up')->nullable();
            
            $table->unsignedInteger('type_id')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable();
            $table->string('status');
            
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('address_city_id')
                ->references('id')
                ->on('places')
                ->onDelete(null);
            $table->foreign('address_state_id')
                ->references('id')
                ->on('places')
                ->onDelete(null);
            $table->foreign('address_country_id')
                ->references('id')
                ->on('places')
                ->onDelete(null);
            $table->foreign('type_id')
                ->references('id')
                ->on('vendor_types')
                ->onDelete(null);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete(null);

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

        Schema::create('user_vendor', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vendor_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['user_id', 'vendor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_vendor');
        Schema::drop('vendors');
    }
}
