<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_original');
            $table->integer('year_launch');
            $table->integer('year_last');
            $table->integer('ended');
            $table->string('country');
            $table->integer('episode_time');
            $table->integer('seasons');
            $table->integer('horror');
            $table->integer('humor');
            $table->integer('drama');
            $table->integer('melodrama');
            $table->integer('trash');
            $table->integer('action');
            $table->integer('erotic');
            $table->integer('beauty');
            $table->integer('concept');
            $table->integer('story');
            $table->integer('fantastic');
            $table->integer('wow');
            $table->integer('criminal');
            $table->string('image');
            $table->string('trailer_link');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serials');
    }
}
