<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTransactionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_lines', function (Blueprint $table) {
            $table->renameColumn('unit_price', 'price');
            $table->unsignedInteger('tax_id')->nullable()->after('item_id');
            $table->renameColumn('tax_rate', 'tax');
            $table->dropColumn('tax_code');

            $table->foreign('tax_id')
                ->references('id')
                ->on('tax_codes')
                ->onUpdate('cascade')
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
        Schema::table('transaction_lines', function (Blueprint $table) {
            $table->renameColumn('price', 'unit_price');
            $table->renameColumn('tax', 'tax_rate');
            $table->string('tax_code')->nullable()->after('tax');
            $table->dropForeign(['tax_id']);
            $table->dropColumn('tax_id');
        });
    }
}
