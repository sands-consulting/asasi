<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxCodeIdToNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->unsignedInteger('tax_code_id')->nullable()->after('submission_address');
            $table->foreign('tax_code_id')
                ->references('id')
                ->on('tax_codes')
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
        Schema::table('notices', function (Blueprint $table) {
            $table->dropForeign(['tax_code_id']);
            $table->dropColumn('tax_code_id');
        });
    }
}
