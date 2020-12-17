<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('photo_id')->unsigned();
            $table->timestamps();
            $table->unique(['tag_id', 'photo_id']);

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('photo_tag');
    }
}
