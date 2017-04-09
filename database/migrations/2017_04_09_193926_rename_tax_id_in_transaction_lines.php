<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTaxIdInTransactionLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_lines', function (Blueprint $table) {
            $table->unsignedInteger('transaction_id')->nullable()->change();
            $table->renameColumn('tax_id', 'tax_code_id');
            $table->decimal('sub_total', 8, 2)->after('quantity');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('gateway_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('gateway_id')->nullable(false)->change();
        });

        Schema::table('transaction_lines', function (Blueprint $table) {
            $table->unsignedInteger('transaction_id')->nullable(false)->change();
            $table->renameColumn('tax_code_id', 'tax_id');
            $table->dropColumn('sub_total');
        });
    }
}
