<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameInvoiceToTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('invoices', 'transactions');
        Schema::rename('invoice_lines', 'transaction_lines');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('transactions', 'invoices');
        Schema::rename('transaction_lines', 'invoice_lines');
    }
}
