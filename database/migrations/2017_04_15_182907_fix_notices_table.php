<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('rules')->nullable()->change();
            $table->text('price')->nullable()->change();
            $table->text('submission_address')->nullable()->change();
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
            $table->text('description')->nullable(false)->change();
            $table->text('rules')->nullable(false)->change();
            $table->text('price')->nullable(false)->change();
            $table->text('submission_address')->nullable(false)->change();
        });
    }
}
