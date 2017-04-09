<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenToUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->string('token')->after('name');
            $table->string('uploadable_type')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->unsignedInteger('uploadable_id')->nullable()->change();
            $table->unsignedInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->string('uploadable_type')->nullable(false)->change();
            $table->string('type')->nullable(false)->change();
            $table->unsignedInteger('uploadable_id')->nullable(false)->change();
            $table->unsignedInteger('user_id')->nullable(false)->change();
        });
    }
}
