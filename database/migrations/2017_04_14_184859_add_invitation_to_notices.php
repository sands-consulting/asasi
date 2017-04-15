<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvitationToNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->boolean('invitation')->after('submission_address')->default(0);
            $table->renameColumn('notice_type_id', 'type_id');
            $table->renameColumn('notice_category_id', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('invitation');
            $table->renameColumn('type_id', 'notice_type_id');
            $table->renameColumn('category_id', 'notice_category_id');
        });
    }
}
