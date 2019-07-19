<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('journalable_type');
            $table->bigInteger('journalable_id')->unsigned();
            $table->string('title');
            $table->string('bankbook_title');
            $table->string('bankbook_code');
            $table->integer('bed');
            $table->integer('bes');
            $table->string('date');
        });

        DB::table('journal_records')->insert(
            array(
                'journalable_type' => 'lastyear',
                'journalable_id' => 0,
                'title' => 'منقول از سال گذشته',
                'bankbook_title' => 'سال',
                'bankbook_code' => '1397',
                'bed' => '0',
                'bes' => '0',
                'date' => '1398-01-01',

            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_records');
    }
}
