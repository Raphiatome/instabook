<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('photo_id')->unsigned();
            $table->bigInteger('comment_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
