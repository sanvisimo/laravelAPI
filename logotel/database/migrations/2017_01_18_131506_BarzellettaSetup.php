<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BarzellettaSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('autore');
            $table->timestamps();
        });

        Schema::create('barzellettas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('barzelletta');
            $table->integer('autore_id')->unsigned()->index();
            $table->integer('visualizzazioni');
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
        Schema::drop('autores');
        Schema::drop('barzellettas');
    }
}
