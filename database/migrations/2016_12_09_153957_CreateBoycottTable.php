<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoycottTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boycotts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('description', 10000);
            $table->integer('created_by_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('boycotts');
    }
}
