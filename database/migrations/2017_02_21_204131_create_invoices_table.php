<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->index();
            $table->decimal('sub_total');
            $table->decimal('tax');
            $table->decimal('total');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vendor_id');
            $table->string('status')->index();
            $table->nullableTimestamps();
            $table->timestamp('paid_at')->nullable();
            $table->softDeletes();

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
        });

        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->decimal('quantity');
            $table->decimal('unit_price');
            $table->string('unit');
            $table->decimal('tax_rate')->nullable();
            $table->string('tax_code')->nullable();
            $table->decimal('total');
            $table->string('item_type')->index();
            $table->unsignedInteger('item_id')->index();
            $table->unsignedInteger('invoice_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
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
        Schema::drop('invoice_lines');
        Schema::drop('invoices');
    }
}
