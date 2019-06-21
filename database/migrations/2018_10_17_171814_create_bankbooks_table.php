<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('code')->length(3)->unsigned();
            $table->string('title')->nullable();
            $table->string('status', 10)->default('active');
            $table->integer('monthly');
            $table->integer('balance')->nullable();
            $table->text('description')->nullable();
            $table->date('created_date');
            $table->date('closed_date')->nullable();
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
        Schema::dropIfExists('bankbooks');
    }
}
