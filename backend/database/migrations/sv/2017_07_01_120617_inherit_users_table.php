<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InheritUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inheritusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');             
            $table->string('email');
            $table->string('password');
            $table->string('wallet', 20);
            $table->integer('timeperiod');
            $table->integer('timeaccept');
            $table->dateTime('timebase')->nullable(); //время отсчета 
            $table->dateTime('timesend')->nullable(); //время отправки ->nullable()
            $table->string('contract', 20)->nullable();
            $table->integer('state');
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
        Schema::dropIfExists('inheritusers');
    }
}
