<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->text('gateway_request_message')->nullable()->after('total');
            $table->text('gateway_respone_message')->nullable()->after('gateway_request_message');
            $table->string('gateway_response_code')->nullable()->after('gateway_respone_message');
            $table->string('gateway_reference_one')->nullable()->after('gateway_response_code');
            $table->string('gateway_reference_two')->nullable()->after('gateway_reference_one');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'gateway_request_message',
                'gateway_respone_message',
                'gateway_response_code',
                'gateway_reference_one',
                'gateway_reference_two'
            ]);
        });
    }
}
