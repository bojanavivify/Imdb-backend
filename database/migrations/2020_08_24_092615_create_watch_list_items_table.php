<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movies_id')->unsigned();
            $table->integer('watch_lists_id')->unsigned();
            $table->enum('status', ['to watch', 'watched'])->default('to watch');
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
        Schema::dropIfExists('watch_list_items');
    }
}
