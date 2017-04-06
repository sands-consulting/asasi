<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidityToQualificationTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualification_types', function (Blueprint $table) {
            $table->string('reference_one')->nullable()->after('code');
            $table->string('reference_two')->nullable()->after('reference_one');
            $table->boolean('validity')->default(0)->after('type');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualification_types', function (Blueprint $table) {
            $table->dropColumn(['reference_one', 'reference_two', 'validity']);
        });
    }
}
