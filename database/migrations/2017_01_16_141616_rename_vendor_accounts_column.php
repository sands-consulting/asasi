<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameVendorAccountsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_accounts', function (Blueprint $table) {
            $table->renameColumn('account_bank_name', 'bank_name');
            $table->renameColumn('account_bank_iban', 'bank_iban');
            $table->renameColumn('account_bank_address', 'bank_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('vendor_accounts', function (Blueprint $table) {
            $table->renameColumn('bank_name', 'account_bank_name');
            $table->renameColumn('bank_iban', 'account_bank_iban');
            $table->renameColumn('bank_address', 'account_bank_address');
        });
    }
}
