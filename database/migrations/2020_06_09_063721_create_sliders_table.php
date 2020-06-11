<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->integer('media_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('target')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media_files');
            $table->foreign('parent_id')->references('id')->on('sliders')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
