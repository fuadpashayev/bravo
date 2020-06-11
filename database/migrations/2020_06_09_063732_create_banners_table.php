<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('target');
            $table->integer('media_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->string('url')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('author_id')->unsigned();
            $table->string('style')->default('noText');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media_files');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
