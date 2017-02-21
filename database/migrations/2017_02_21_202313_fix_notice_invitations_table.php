<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticeInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('notice_invitation', 'notice_invitations');

        Schema::table('notice_invitations', function (Blueprint $table) {
            $table->timestamp('sent_at')->nullable()->after('updated_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_invitations', function (Blueprint $table) {
            $table->dropColumn('sent_at');
        });

        Schema::rename('notice_invitations', 'notice_invitation');
    }
}
