<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->string('tax_code');
            $table->decimal('tax_rate', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total');
            $table->string('item_type')->index();
            $table->unsignedInteger('item_id')->index();
            $table->unsignedInteger('transaction_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
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
        Schema::drop('transaction_details');
    }
}
