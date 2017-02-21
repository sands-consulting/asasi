<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticeVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('notice_vendor', 'notice_purchases');

        Schema::table('notice_purchases', function (Blueprint $table) {
            $table->string('number')->index()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_purchases', function (Blueprint $table) {
            $table->dropColumn('number');
        });

        Schema::rename('notice_purchases', 'notice_vendor');
    }
}
