<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_id');
            $table->string('locale');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('content')->nullable();
            $table->text('media')->nullable()->nullable();
            $table->timestamp('date')->nullable();
            $table->bigInteger('read')->unsigned();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('posts');
    }
}
