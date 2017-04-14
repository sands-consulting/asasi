<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice_events', function (Blueprint $table) {
            $table->renameColumn('event_at', 'schedule_at');
            $table->renameColumn('notice_event_type_id', 'type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_events', function (Blueprint $table) {
            $table->renameColumn('schedule_at', 'event_at');
            $table->renameColumn('type_id', 'notice_event_type_id');
        });
    }
}
