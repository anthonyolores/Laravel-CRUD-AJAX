<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistraionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('registrationtable', function (Blueprint $table) {
      $table->increments('id');
      $table->string('firstname');
      $table->string('lastname');
      $table->string('username');
      $table->string('email');
      $table->string('password');
      $table->integer('age');
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
        //
    }
}
