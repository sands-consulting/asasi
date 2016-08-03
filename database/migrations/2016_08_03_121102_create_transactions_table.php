<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('sub_total');
            $table->decimal('discount');
            $table->decimal('tax_total');
            $table->decimal('total');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('payment_gateway_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('payment_gateway_id')
                ->references('id')->on('payment_gateways')
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('transactions');
        Schema::enableForeignKeyConstraints();
    }
}
