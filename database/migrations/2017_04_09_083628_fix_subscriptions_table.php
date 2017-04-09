<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('started_at', 'start_at');
            $table->renameColumn('expired_at', 'end_at');
            $table->timestamp('paid_at')->after('updated_at')->nullable();
            $table->string('number')->after('id')->index();
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
            $table->renameColumn('start_at', 'started_at');
            $table->renameColumn('end_at', 'expired_at');
            $table->dropColumn(['paid_at', 'number']);
        });
    }
}
