<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBankbookReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bankbook_receipts', function (Blueprint $table) {
            $table->enum('type', ['deposit', 'withdraw'])->after('amount');
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bankbook_receipts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
