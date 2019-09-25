<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_tikets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->unsigned()->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->string('invoice');
            $table->integer('tipe');
            $table->integer('metode');
            $table->text('notes');
            $table->bigInteger('nominal');
            $table->integer('status');
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
        Schema::dropIfExists('deposit_tikets');
    }
}
