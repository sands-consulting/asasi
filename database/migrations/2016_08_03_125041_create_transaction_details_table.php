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
            $table->decimal('unit_price');
            $table->integer('quantity');
            $table->string('tax_code');
            $table->decimal('tax_rate');
            $table->decimal('tax_amount');
            $table->decimal('total');
            $table->unsignedInteger('detailable_id');
            $table->string('detailable_type');
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('transaction_details');
        Schema::enableForeignKeyConstraints();
    }
}
