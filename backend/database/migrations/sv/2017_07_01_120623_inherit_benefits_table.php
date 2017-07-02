<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InheritBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inheritbenefits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('wallet', 20);
            $table->string('email');
            $table->decimal('part', 5, 2)->nullable();
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
        Schema::dropIfExists('inheritbenefits');
    }
}
