<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostdatedChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postdated__cheques', function (Blueprint $table) {
            $table->bigInteger('chequeNo');
            $table->date('chequeDate');
            $table->double('ChequeBalance');
            $table->string('Branch');
            $table->string('Bank');
            $table->integer('CustomerID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postdated__cheques');
    }
}
