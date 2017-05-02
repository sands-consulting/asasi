<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice_purchases', function (Blueprint $table) {
            $table->foreign('notice_id')
                ->references('id')
                ->on('notices')
                ->onDelete('cascade');
            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
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
        Schema::table('notice_purchases', function (Blueprint $table) {
            $table->dropForeign(['notice_id']);
            $table->dropForeign(['vendor_id']);
        });
    }
}
