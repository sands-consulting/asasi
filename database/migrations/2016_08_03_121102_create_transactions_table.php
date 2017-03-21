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
            $table->string('number')->index();
            $table->decimal('sub_total', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('payee_type')->index();
            $table->unsignedInteger('payee_id')->index();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('gateway_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->timestamp('paid_at')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('gateway_id')
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
        Schema::drop('transactions');
    }
}
