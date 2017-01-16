<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNodeToQualificationCodeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualification_code_types', function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->after('id')->index();
            $table->integer('lft')->nullable()->after('parent_id')->index();
            $table->integer('rgt')->nullable()->after('lft')->index();
            $table->integer('depth')->after('rgt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualification_code_types', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('lft');
            $table->dropColumn('rgt');
            $table->dropColumn('depth');
        });
    }
}
