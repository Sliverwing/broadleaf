<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_direct_link')->default(false);
            $table->boolean('is_top')->default(false);
            $table->string('intro')->nullable();
            $table->integer('views_count')->default(0);
            $table->string('banner')->nullable();
            $table->string('reference_link')->nullable();
            $table->text('content')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->enum('status', ['published', 'draft', 'hidden'])->default('published');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('articles');
    }
}
