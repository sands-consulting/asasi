<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticeEligiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice_eligibles', function (Blueprint $table) {
            $table->text('remarks')->after('exception')->nullable(true);
            $table->renameColumn('sent_at', 'notified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_eligibles', function (Blueprint $table) {
            $table->dropColumn('remarks');
            $table->renameColumn('notified_at', 'sent_at');
        });
    }
}
