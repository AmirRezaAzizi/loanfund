<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->length(4)->unsigned();
            $table->string('fname', 30);
            $table->string('lname', 30);
            $table->string('status', 10)->default('active');
            $table->string('father', 30)->nullable();
            $table->string('national', 10)->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('birth')->nullable();
            $table->text('address')->nullable();
            $table->string('post')->nullable();
            $table->string('reference')->nullable();
            $table->string('sponsor')->nullable();
            $table->timestamps();
            $table->unique('code');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
