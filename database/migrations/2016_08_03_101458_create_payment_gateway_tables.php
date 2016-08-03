<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewayTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('type');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->index('label');
            $table->index('type');
            $table->index('status');
        });

        Schema::create('organization_payment_gateway', function (Blueprint $table) {
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('payment_gateway_id');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('payment_gateway_id')
                ->references('id')
                ->on('payment_gateways')
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
        Schema::drop('organization_payment_gateway');
        Schema::drop('payment_gateways');
    }
}
