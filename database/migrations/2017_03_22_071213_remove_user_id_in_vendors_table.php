<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdInVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['address_city_id']);
            $table->dropForeign(['address_state_id']);
            $table->dropForeign(['address_country_id']);
            $table->dropColumn(['address_1', 'address_2', 'address_postcode', 'address_city_id', 'address_state_id', 'address_country_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->after('type_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete(null);

            $table->string('address_1')->nullable()->after('tax_2_number');
            $table->string('address_2')->nullable()->after('address_1');
            $table->string('address_postcode')->nullable()->after('address_2');
            $table->unsignedInteger('address_city_id')->nullable()->default(null)->after('address_postcode');
            $table->unsignedInteger('address_state_id')->nullable()->default(null)->after('address_city_id');
            $table->unsignedInteger('address_country_id')->nullable()->default(null)->after('address_state_id');

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
        });
    }
}
