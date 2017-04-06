<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentageToVendorShareholders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_shareholders', function (Blueprint $table) {
            $table->decimal('percentage', 5, 2)->after('identity_number')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_shareholders', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
    }
}
