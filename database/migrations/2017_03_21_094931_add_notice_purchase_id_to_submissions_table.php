<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoticePurchaseIdToSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedInteger('purchase_id')->default(1)->after('total_score');

            $table->foreign('purchase_id')
                ->references('id')
                ->on('notice_purchases')
                ->onDelete('cascade');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['notice_id']);
            $table->dropColumn('notice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['purchase_id']);
            $table->dropColumn('purchase_id');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedInteger('notice_id')->default(1)->after('total_score');

            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');
        });
    }
}
