<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoycottConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boycott_concerns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('boycott_id')->unsigned();
            $table->integer('concern_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('boycott_id')
                ->references('id')
                ->on('boycotts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('concern_id')
                ->references('id')
                ->on('concerns')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boycott_concerns');
    }
}
