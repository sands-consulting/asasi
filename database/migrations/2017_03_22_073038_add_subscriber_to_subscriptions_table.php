<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriberToSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('payee_id', 'payer_id');
            $table->renameColumn('payee_type', 'payer_type');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');

            $table->string('subscriber_type')->after('package_id')->nullable()->index();
            $table->unsignedInteger('subscriber_id')->after('subscriber_type')->nullable()->index();
            $table->unsignedInteger('user_id')->nullable()->after('subscriber_id');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'subscriber_type', 'subscriber_id']);

            $table->unsignedInteger('vendor_id')->nullable()->after('expired_at');
            
            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('payer_id', 'payee_id');
            $table->renameColumn('payer_type', 'payee_type');
        });
    }
}
