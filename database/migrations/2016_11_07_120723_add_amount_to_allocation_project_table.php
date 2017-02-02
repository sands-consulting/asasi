<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmountToAllocationProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allocation_project', function (Blueprint $table) {
            $table->decimal('amount')->nullable()->after('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allocation_project', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
}
