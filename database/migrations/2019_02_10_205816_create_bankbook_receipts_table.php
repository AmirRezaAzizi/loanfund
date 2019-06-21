<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankbookReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankbook_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bankbook_id');
            $table->date('date');
            $table->integer('amount');
            $table->enum('type', ['deposit', 'withdraw']);
            $table->boolean('confirmed')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bankbook_receipts');
    }
}
