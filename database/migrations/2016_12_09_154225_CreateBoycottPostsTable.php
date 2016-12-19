<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoycottPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boycott_posts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('boycott_id')->unsigned();
            $table->string('text', 10000);
            $table->timestamps();

            $table->foreign('boycott_id')
                ->references('id')
                ->on('boycotts')
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
        Schema::drop('boycott_posts');
    }
}
