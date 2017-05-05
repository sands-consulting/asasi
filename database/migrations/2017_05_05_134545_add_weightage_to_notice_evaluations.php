<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightageToNoticeEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice_evaluations', function (Blueprint $table) {
            $table->decimal('weightage', 5, 2)->nullable(false)->after('end_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_evaluations', function (Blueprint $table) {
            $table->dropColumn('weightage');
        });
    }
}
