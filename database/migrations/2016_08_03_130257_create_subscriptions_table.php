<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('package_id');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onDelete('cascade');

            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
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
        Schema::drop('subscriptions');
        Schema::enableForeignKeyConstraints();
    }
}
