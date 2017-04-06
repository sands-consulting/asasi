<?php

use App\Notice;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalNoticesStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->string('status_submission')->after('organization_id')->index();
            $table->string('status_award')->after('status_submission')->index();
        });

        foreach(Notice::all() as $notice)
        {
            $notice->update([
                'status_submission' => 'pending',
                'status_award' => 'pending'
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn(['status_submission', 'status_award']);
        });
    }
}
