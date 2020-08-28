<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMoviesTableAddImageIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('image_movies_id')->unsigned()->nullable();
            $table->foreign('image_movies_id')
                  ->references('id')
                  ->on('image_movies')
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
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['image_movies_id']);
            $table->dropColumn('image_movies_id');
        });
    }
}
