<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->integer('media_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('target')->nullable();
            $table->integer('order');
            $table->boolean('status')->default(true);
            $table->bigInteger('author_id')->unsigned();
            $table->timestamp('date')->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('offers')->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::dropIfExists('offers');
    }
}
