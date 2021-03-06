<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('photo')->default('profile.jpeg');
            $table->string('email')->unique();
            $table->string('NIC')->unique()->nullable();
            $table->integer('Telephone')->zerofill();
            $table->enum('type', ['StockKeeper', 'Cashier','Accountant','Admin']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::unprepared("ALTER TABLE  `users` CHANGE  `Telephone`  `Telephone` INT( 10 ) UNSIGNED ZEROFILL ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
