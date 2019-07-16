<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('photocontest_id')->unsigned();
            $table->integer('participant_id')->unsigned();

            $table->string('file_name')->unique();
            $table->string('mime');
            $table->string('ext');
            $table->integer('size');

            $table->integer('like')->unsigned();

            $table->boolean('is_active')->default(false);

            $table->timestamps();

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
