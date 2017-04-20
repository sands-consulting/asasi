<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToEvaluationTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluation_types', function (Blueprint $table) {
            $table->boolean('price')->after('slug')->default(0);
            $table->boolean('period')->after('slug')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_types', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('period');
        });
    }
}
