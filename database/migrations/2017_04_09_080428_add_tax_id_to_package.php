<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxIdToPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['fee_tax_code', 'fee_tax_rate']);
            $table->renameColumn('label_color', 'color');
            $table->unsignedInteger('tax_code_id')->after('label_color')->nullable();

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
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign(['tax_code_id']);
            $table->dropColumn('tax_code_id');
            $table->renameColumn('color', 'label_color');
            $table->string('fee_tax_code')->after('fee_amount');
            $table->decimal('fee_tax_rate')->after('fee_tax_code');
        });
    }
}
