<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutstandingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outstanding__payments', function (Blueprint $table) {
            $table->bigIncrements('OrderNo');
            $table->integer('InvoiceNo');
            $table->integer('CustomerID');
            $table->double('InvoiceValue')->default(0);
            $table->double('SettledAmount')->default(0);
            $table->double('Balance')->default(0);
            $table->integer('Age')->default(0);
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
        Schema::dropIfExists('outstanding__payments');
    }
}
