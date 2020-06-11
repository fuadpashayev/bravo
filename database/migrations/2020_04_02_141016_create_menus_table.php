<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('target')->nullable();
            $table->string('url')->nullable();
            $table->integer('order');
            $table->boolean('status')->default(true);
            $table->bigInteger('author_id')->unsigned();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('menus')
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
        Schema::dropIfExists('menus');
    }
}
