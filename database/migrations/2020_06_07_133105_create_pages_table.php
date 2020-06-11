<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_id');
            $table->string('locale');
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('media')->nullable();
            $table->timestamp('date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('menu_id')->references('id')->on('menus')
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
        Schema::dropIfExists('pages');
    }
}
